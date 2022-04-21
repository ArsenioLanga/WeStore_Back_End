<?php

use core\classes\Database;

// ABRIR A SESSAO
session_start();

// CARREGA TODAS AS CLASSES do PROJECTO
require_once('../vendor/autoload.php');

// CARREGAR O SISTEMA DE ROUTAS
require_once('../core/route.php');
