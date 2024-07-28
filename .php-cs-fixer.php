<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('plugins/OAuth2/vendor')
    ->notPath('plugins/OAuth2/processbounces.php')
    ->in(__DIR__)
;
$config = new PhpCsFixer\Config();

return $config->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        '@Symfony' => true,
        'concat_space' => false,
        'phpdoc_no_alias_tag' => false,
        'yoda_style' => false,
        'array_syntax' => false,
        'no_superfluous_phpdoc_tags' => false,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => ['class', 'function', 'const'],
        ],
        'blank_line_after_namespace' => true,
        'single_line_comment_style' => false,
        'visibility_required' => false,
        'phpdoc_to_comment' => false,
        'type_declaration_spaces' => false,
        'global_namespace_import' => false,
        'fully_qualified_strict_types' => false,
        'echo_tag_syntax' => false,
    ])
    ->setFinder($finder)
;
