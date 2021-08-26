<?php

    require_once __DIR__.'/../domain/validators/MaterialValidator.php';
    require_once __DIR__.'/../infrastructure/repositories/MaterialMysqlRepository.php';
    require_once __DIR__.'/../application/services/MaterialService.php';

    class MaterialConfiguration {

        public static function getConfiguration(): MaterialService {
            $repository = new MaterialMysqlRepository();
            $validator = new MaterialValidator();
            return new MaterialService($repository, $validator);
        }
    }
?>