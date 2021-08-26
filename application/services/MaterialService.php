<?php

    include_once __DIR__.'/../../domain/entities/Material.php';
    include_once __DIR__.'/../../domain/validators/MaterialValidator.php';
    include_once __DIR__.'/../interfaces/MaterialRepository.php';

    class MaterialService {

        private MaterialRepository $materialRepository;
        private MaterialValidator $materialValidator;

        public function __construct(MaterialRepository $materialRepository, MaterialValidator $materialValidator)
        {
            $this->materialRepository = $materialRepository;
            $this->materialValidator = $materialValidator;
        }

        public function getTotal(): int {
            return $this->materialRepository->getTotal();
        }

        public function getAll(int $start, int $limit): array {
            $result = array();
            if($start < 0 || $limit < 0) return $result;
            return $this->materialRepository->getAll($start, $limit);
        }

        public function add(Material $material): Material {
            if(!isset($material)) throw new Exception("The material to add is undefined!");
            $material->setId(-1);

            $this->materialValidator->setMaterial($material);
            if(!$this->materialValidator->isNameValid()) 
                throw new Exception("The length of the name must be between 2 and 1024.");
            if(!$this->materialValidator->isYearValid())
                throw new Exception("The year must be positive.");
            if(!$this->materialValidator->isImageValid())
                throw new Exception("The length of the image must be less than 1024.");
            if(!$this->materialValidator->isUrlImdbValid())
                throw new Exception("The length of the url imdb must be less than 1024.");

            $materialWithSameName = $this->materialRepository->getByName($material->getName());
            if(count($materialWithSameName) > 0){
                throw new Exception("The material with name " . $material->getName() . " is already inserted in database!");
            }

            return $this->materialRepository->add($material);
        }

        public function update(Material $material): void {
            if(!isset($material)) throw new Exception("The material to update is undefined!");

            $this->materialValidator->setMaterial($material);
            if(!$this->materialValidator->isIdValid())
                throw new Exception("The id is less or equal to 0.");
            if(!$this->materialValidator->isNameValid()) 
                throw new Exception("The length of the name must be between 2 and 1024.");
            if(!$this->materialValidator->isYearValid())
                throw new Exception("The year must be positive.");
            if(!$this->materialValidator->isImageValid())
                throw new Exception("The length of the image must be less than 1024.");
            if(!$this->materialValidator->isUrlImdbValid())
                throw new Exception("The length of the url imdb must be less than 1024.");

            $materialWithSameName = $this->materialRepository->getByName($material->getName());

            if(count($materialWithSameName) > 0){
                if($materialWithSameName[0]->getId() != $material->getId()){
                    throw new Exception("The material with name " . $material->getName() . " is already inserted in database!");
                }
            }

            $this->materialRepository->update($material);
        }
    }

?>