<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    'align_multiline_comment'              => false,
    'array_indentation'                    => false,
    "array_syntax"                         => ['syntax' => 'short'],
    'binary_operator_spaces'               => [
        'default'   => 'align',
        'operators' => ['=' => 'align'],
    ],
    'blank_line_after_namespace'           => true,
    'blank_line_after_opening_tag'         => false,
    'blank_line_before_return'             => true,
    'blank_line_before_statement'          => ['statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try']],
    'braces'                               => [
        'allow_single_line_closure'                   => false,
        'position_after_anonymous_constructs'         => 'same',
        'position_after_control_structures'           => 'same',
        'position_after_functions_and_oop_constructs' => 'next',
    ],
    'cast_spaces'                          => ['space' => 'none'],
    'class_attributes_separation'          => [
        'elements' => ['method', 'property'],
    ],
    'class_keyword_remove'                 => false,
    'combine_consecutive_issets'           => false,
    'combine_consecutive_unsets'           => false,
    'combine_nested_dirname'               => false,
    'comment_to_phpdoc'                    => false,
    'compact_nullable_typehint'            => false,
    'concat_space'                         => ['spacing' => 'one'],
    'constant_case'                        => [
        'case' => 'lower',
    ],
    'date_time_immutable'                  => false,
    'declare_equal_normalize'              => [
        'space' => 'single',
    ],
    'declare_strict_types'                 => false,
    'dir_constant'                         => false,
    'doctrine_annotation_array_assignment' => false,
    'doctrine_annotation_braces'           => false,
    'doctrine_annotation_indentation'      => [
        'ignored_tags'       => [],
        'indent_mixed_lines' => true,
    ],
    'doctrine_annotation_spaces'           => [
        'after_argument_assignments'     => false,
        'after_array_assignments_colon'  => false,
        'after_array_assignments_equals' => false,
    ],
    'elseif'                               => false,
    'encoding'                             => true,
    'indentation_type'                     => true,
    'no_useless_else'                      => true,
    'no_useless_return'                    => true,
    'ordered_imports'                      => true,
    'single_quote'                         => false,
    'ternary_operator_spaces'              => true,
    'trailing_comma_in_multiline_array'    => true,
];

$finder = Finder::create();

$finder->in([
    'app',
    'database',
    'config',
]);

$finder->exclude('');

$config = Config::create();

$config->setIndent("    ");

$config
    ->setRiskyAllowed(false)
    ->setRules($rules)
    ->setFinder($finder);

return $config;
