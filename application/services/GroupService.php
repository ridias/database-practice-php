<?php

    include_once __DIR__.'/../../domain/entities/Group.php';
    include_once __DIR__.'/../../domain/validators/GroupValidator.php';
    include_once __DIR__.'/../interfaces/GroupRepository.php';

    class GroupService {

        private GroupRepository $groupRepository;
        private GroupValidator $groupValidator;

        public function __construct(GroupRepository $groupRepository, GroupValidator $groupValidator)
        {
            $this->groupRepository = $groupRepository;
            $this->groupValidator = $groupValidator;
        }

        public function getAllByUserId(int $idUser): array {
            $result = array();
            if($idUser <= 0) return $result;
            return $this->groupRepository->getAllByUserId($idUser);
        }

        public function getGroupById(int $id, int $idUser){
            $result = array();
            if($idUser <= 0 || $id <= 0) return $result;
            return $this->groupRepository->getGroupById($id, $idUser);
        }

        public function add(Group $group): Group {
            if(!isset($group)) throw new Exception("The group to add is undefined!");
            
            $group->setId(-1);
            $this->groupValidator->setGroup($group);
            if(!$this->groupValidator->isNameValid()) 
                throw new Exception("The name of the group is not valid");
            if(!$this->groupValidator->isDescriptionValid()) 
                throw new Exception("The length of the description must be between 2 and 150.");
            if(!$this->groupValidator->isUserValid()) 
                throw new Exception("The user id is less or equal to 0, it's not valid.");
            
            return $this->groupRepository->add($group);
        }

        public function update(Group $group): void {
            if(!isset($group)) throw new Exception("The group to update is undefined!");

            $this->groupValidator->setGroup($group);
            if(!$this->groupValidator->isIdValid())
                throw new Exception("The id is less or equal to 0, it's not valid.");
            if(!$this->groupValidator->isNameValid()) 
                throw new Exception("The name of the group is not valid");
            if(!$this->groupValidator->isDescriptionValid()) 
                throw new Exception("The length of the description must be between 2 and 150.");
            if(!$this->groupValidator->isUserValid()) 
                throw new Exception("The user id is less or equal to 0, it's not valid.");

            $this->groupRepository->update($group);
        }

        public function delete(int $id): void {
            if($id <= 0) return ;
            $this->groupRepository->delete($id);
        }
    }
?>