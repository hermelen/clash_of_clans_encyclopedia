<?php
{% if DarkBarracks is not null %}
  <ul class = "ul_list_items">
    {% for DarkBarrack in DarkBarracks %}
      <li class = "li_list_items">
        <a href="{{ path('her_dark_barrack_single', {'level':DarkBarrack.level} ) }}">
          <div class="li_div_list_items">
            <p class = "level_list_items">{{ DarkBarrack.level }}</p>
            <img class= "img_list_items"
            src="{{ asset(DarkBarrack.image.uploadDir ~ '/' ~ DarkBarrack.image.id ~ '.' ~ DarkBarrack.image.ext) }}"
            alt="{{ DarkBarrack.image.alt }}"/>
          </div>
        </a>
      </li>
    {% endfor %}
  </ul>
{% endif %}

public function durationSec($duration){

    if ($duration > 86400){
      switch($duration){
        case ($duration < 172800): {
          $jour = floor($duration / 86400).' jour ';
          break;
        }
        case ($duration > 172800): {
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
    }

    if ($duration % 1440 > 0){
      switch($duration){
        case ($duration % 1440 >= 120): {
          $min = floor(($duration % 1440) / 60).' minutes ';
          break;
        }
        case ($duration % 1440 >= 60 && $duration % 1440 < 120 ): {
          $min = floor(($duration % 1440) / 60).' minute ';
          break;
        }
        case ($duration % 1440 < 60 ): {
          $min = '';
          break;
        }
      }
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
