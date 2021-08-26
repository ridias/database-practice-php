<?php

    require_once __DIR__.'/domain/validators/ObjectiveValidator.php';
    require_once __DIR__.'/infrastructure/repositories/ObjectiveMysqlRepository.php';
    require_once __DIR__.'/application/services/ObjectiveService.php';

    class ObjectiveConfiguration {

        public static function getConfiguration(): ObjectiveService {
            $repository = new ObjectiveMysqlRepository();
            $validator = new ObjectiveValidator();
            return new ObjectiveService($repository, $validator);
        }
    }
?>