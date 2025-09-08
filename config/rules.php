<?php

const RULES_DESCRIPTION = [
    'title' => [
        'min' => 1,
        'max' => 20,
    ],
    'category' => [
        'min' => 1,
        'max' => 50,
    ],
    'price' => [
        'min' => 1,
        'max' => 10,
    ],
    'project_url' => [
        'min' => 3,
        'max' => 100,
    ],
    'project_des' => [
        'min' => 3,
        'max' => 100,
    ]
];
const RULES_PROJECT = [
    'type' => [
//        'required' => true,
        'min' => 1,
        'max' => 30,
    ],
    'mode' => [
        'min' => 1,
        'max' => 4,
    ],
    'street' => [
        'min' => 2,
        'max' => 100,
    ],
    'apartment' => [
        'min' => 1,
        'max' => 50,
    ],
    'fileName' => [
//        'min' => 3,
        'max' => 100,
    ],
    'docFile' => [
//        'required' => true,
        'ext' => 'xls|xlsx',
        'size' => 10_048_576,
    ],
];
