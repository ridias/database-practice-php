<?php

    require_once __DIR__.'/../domain/validators/GroupValidator.php';
    require_once __DIR__.'/../infrastructure/repositories/GroupMysqlRepository.php';
    require_once __DIR__.'/../application/services/GroupService.php';
    require_once __DIR__.'/../domain/entities/Group.php';

    class GroupConfiguration {

        public static function getConfiguration(): GroupService {
            $repository = new GroupMysqlRepository();
            $validator = new GroupValidator();
            return new GroupService($repository, $validator);
        }
    }
?>