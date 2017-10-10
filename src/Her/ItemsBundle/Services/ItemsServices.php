<?php

namespace Her\ItemsBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ItemsServices
{
    public function durationMin($duration){

        if ($duration >= 1440){
          switch($duration){
            case ($duration < 2880): {
              $jour = floor($duration / 1440).' jour ';
              break;
            }
            case ($duration >= 2880): {
              $jour = floor($duration / 1440).' jours ';
              break;
            }
          }
        } else {
          $jour = '';
        }

        if ($duration % 1440 > 0){
          switch($duration){
            case ($duration % 1440 >= 120): {
              $heure = floor(($duration % 1440) / 60).' heures ';
              break;
            }
            case ($duration % 1440 >= 60 && $duration % 1440 < 120 ): {
              $heure = floor(($duration % 1440) / 60).' heure ';
              break;
            }
            case ($duration % 1440 < 60 ): {
              $heure = '';
              break;
            }
          }
        }else{
          $heure = '';
        }

        if ($duration % 60 > 0){
          if ($duration % 60 > 1){
            $min = ($duration % 60).' minutes';
          }else{
            $min = ($duration % 60).' minute';
          }
        } else {
          $min = '';
        }

        $result = $jour.$heure.$min;

        return $result;
    }

    public function durationSec($duration){

        if ($duration >= 86400){
          switch($duration){
            case ($duration < 172800): {
              $jour = floor($duration / 86400).' jour ';
              break;
            }
            case ($duration >= 172800): {
              $jour = floor($duration / 86400).' jours ';
              break;
            }
          }
        } else {
          $jour = '';
        }

        if ($duration % 86400 > 0){
          switch($duration){
            case ($duration % 86400 >= 7200): {
              $heure = floor(($duration % 86400) / 3600).' heures ';
              break;
            }
            case ($duration % 86400 >= 3600 && $duration % 1440 < 7200 ): {
              $heure = floor(($duration % 86400) / 3600).' heure ';
              break;
            }
            case ($duration % 86400 < 3600 ): {
              $heure = '';
              break;
            }
          }
        } else {
          $heure = '';
        }

        if ($duration % 3600 > 0){
          switch($duration){
            case ($duration % 3600 >= 120): {
              $min = floor(($duration % 3600) / 60).' minutes ';
              break;
            }
            case ($duration % 3600 >= 60 && $duration % 3600 < 120 ): {
              $min = floor(($duration % 3600) / 60).' minute ';
              break;
            }
            case ($duration % 3600 < 60 ): {
              $min = '';
              break;
            }
          }
        } else {
          $min = '';
        }



        if ($duration % 60 > 0){
          if ($duration % 60 > 1){
            $sec = ($duration % 60).' secondes ';
          }else{
            $sec = ($duration % 60).' seconde ';
          }
        } else {
          $sec = '';
        }

        $result = $jour.$heure.$min.$sec;

        return $result;
    }
}
