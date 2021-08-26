<?php

    include __DIR__.'/config/MaterialConfiguration.php';
    //include __DIR__.'/config/ObjectiveConfiguration.php';
    include __DIR__.'/config/GroupConfiguration.php';

    $groupService = GroupConfiguration::getConfiguration();
    //$objectiveService  = ObjectiveConfiguration::getConfiguration();
    $materialService = MaterialConfiguration::getConfiguration();


    $result = $materialService->getAll(0, 20);
    for($i = 0; $i < count($result); $i++){
      echo $result[$i]->toString() . "<br>";
    }

    $result = $materialService->getTotal();
    echo "Total: " . $result . "<br>";


    $material = new Material();
    $material->setName("Game of Thrones");
    $material->setYear(2011);
    $material->setDateCreated(new DateTime("2021-08-26 14:04:00"));
    $material->setUrlImage("https://m.media-amazon.com/images/M/MV5BYTRiNDQwYz…VyNDIzMzcwNjc@._V1_QL75_UY562_CR17,0,380,562_.jpg");
    $material->setUrlDetails("https://www.imdb.com/title/tt0944947/");
    try { 
      $result = $materialService->add($material);
      echo $result->toString();
    }catch(Exception $ex){
      echo "Already duplicated <br>";
    }
    echo "<br>";
    echo "<br>";

    echo "Updating <br>";
    $material->setId(5);
    $material->setName("Game of Thrones");
    
    try {
      $materialService->update($material);
    }catch(Exception $ex){
      echo "Already existing the name " . $material->getName(); 
    }

    echo "<br>";
    echo "<br>";
?>