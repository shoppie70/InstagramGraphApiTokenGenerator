<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database/seeders',
        __DIR__ . '/tests',
    ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony'                  => true,
        '@PhpCsFixer:risky'         => true,
        '@PHP80Migration'           => true,
        '@PHP80Migration:risky'     => true,
        '@PSR12'                    => true,
        '@PHPUnit84Migration:risky' => true,

        // Alias
        'ereg_to_preg'     => true,
        'mb_str_functions' => true,

        // Array Notation

        // Basic

        // Casing

        // Cast Notation

        // Class Notation
        'class_attributes_separation' => [
            'elements' => ['method' => 'one']
        ],
        'self_static_accessor'            => true,
        'no_null_property_initialization' => true,

        // Class Usage

        // Comment
        'multiline_comment_opening_closing' => true,

        // Constant Notation

        // Control Structure
        'no_superfluous_elseif' => true,
        'no_useless_else'       => true,
        'yoda_style'            => false,

        // Doctrine Annotation

        // Function Notation
        'static_lambda'       => true,
        'single_line_throw'   => false,
        'use_arrow_functions' => false,

        // import
        'global_namespace_import' => [
            'import_classes'   => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order'  => [
                'class',
                'function',
                'const'
            ],
        ],

        // Language Construct

        // List Notation

        // Namespace Notation

        // Naming

        // Operator
        'concat_space' => [
            'spacing' => 'one'
        ],
        'new_with_braces' => true,

        // PHP Tag

        // PHPUnit
        'php_unit_strict'        => false,
        'php_unit_method_casing' => [
            'case' => 'snake_case'
        ],
        'php_unit_test_annotation' => [
            'style' => 'annotation'
        ],
        'php_unit_test_case_static_method_calls' => [
            'call_type' => 'this'
        ],


        // PHPDoc
        'align_multiline_comment'   => true,
        'general_phpdoc_tag_rename' => [
            'replacements' => [
                'inheritDocs' => 'inheritDoc',
            ]
        ],
        'no_superfluous_phpdoc_tags' => [
            'allow_mixed'         => true,
            'allow_unused_params' => true,
        ],
        'phpdoc_no_empty_return'              => true,
        'phpdoc_order'                        => true,
        'phpdoc_order_by_value'               => true,
        'phpdoc_var_annotation_correct_order' => true,

        // Return Notation
        'no_useless_return' => true,
        'return_assignment' => true,

        // Semicolon
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],

        // Strict
        'declare_strict_types' => false,

        // String Notation
        'escape_implicit_backslashes'       => true,
        'explicit_string_variable'          => true,
        'heredoc_to_nowdoc'                 => true,
        'simple_to_complex_string_variable' => true,

        // Whitespace
        'array_indentation'           => true,
        'method_chaining_indentation' => true,
    ])
    ->setFinder($finder);
