module.exports = {
    env:           {
        browser: true,
        es6:     true,
    },
    extends:       [
        'plugin:vue/recommended',
        'airbnb-base',
    ],
    globals:       {
        Atomics:           'readonly',
        SharedArrayBuffer: 'readonly',
    },
    parserOptions: {
        ecmaVersion: 2018,
        sourceType:  'module',
    },
    plugins:       [
        'vue',
        'arca',
    ],
    rules:         {
        'arca/curly':                        ['off'],
        'arca/import-align':                 ['error'],
        'arca/import-ordering':              ['error'],
        'arca/melted-constructs':            ['off'],
        'arca/newline-after-import-section': ['off'],
        'arca/no-default-export':            ['off'],
        indent:                              ['error', 4, {
            SwitchCase:             1,
            VariableDeclarator:     1,
            outerIIFEBody:          1,
            FunctionDeclaration:    {
                parameters: 1,
                body:       1,
            },
            FunctionExpression:     {
                parameters: 1,
                body:       1,
            },
            CallExpression:         {
                arguments: 1,
            },
            ArrayExpression:        1,
            ObjectExpression:       1,
            ImportDeclaration:      1,
            flatTernaryExpressions: false,
            ignoredNodes:           ['JSXElement', 'JSXElement > *', 'JSXAttribute', 'JSXIdentifier', 'JSXNamespacedName', 'JSXMemberExpression', 'JSXSpreadAttribute', 'JSXExpressionContainer', 'JSXOpeningElement', 'JSXClosingElement', 'JSXText', 'JSXEmptyExpression', 'JSXSpreadChild'],
            ignoreComments:         false,
        }],
        'func-names':                        ['off'],
        'import/no-extraneous-dependencies': ['error', {
            devDependencies:      true,
            optionalDependencies: false,
        }],
        'import/no-unresolved':              ['off'],
        'key-spacing':                       ['error', {
            'multiLine': {
                'beforeColon': false,
                'afterColon':  true,
                'mode':        'minimum',
            },
            'align':     {
                'beforeColon': false,
                'afterColon':  true,
                'on':          'value',
                'mode':        'minimum',
            },
        }],
        'max-classes-per-file':              'off',
        'max-len':                           'off',
        'no-console':                        'error',
        'no-continue':                       'off',
        'no-multi-spaces':                   ['error', {
            'exceptions': {
                'AssignmentExpression': true,
                'BinaryExpression':     true,
                'ImportDeclaration':    true,
                'Property':             true,
                'VariableDeclarator':   true,
            },
        }],
        'no-plusplus':                       'off',
        'no-restricted-syntax':              ['error'],
        'no-new':                            'off',
        'no-prototype-builtins':             'off',
        'object-curly-spacing':              ['error', 'never'],
        'prefer-destructuring':              'off',
        'vue/attributes-order':              'error',
        'vue/html-closing-bracket-newline':  ['error', {
            multiline:  'never',
            singleline: 'never',
        }],
        'vue/html-closing-bracket-spacing':  ['error'],
        'vue/html-indent':                   ['error', 4, {
            'alignAttributesVertically': true,
        }],
        'vue/html-self-closing':             ['error'],
        'vue/max-attributes-per-line':       'off',
        'vue/no-multi-spaces':               ['error', {
            'ignoreProperties': false,
        }],
        'vue/require-prop-types':            ['error'],
        'vue/script-indent':                 ['error', 4, {
            'baseIndent': 1,
            'switchCase': 1,
        }],
    },
    'overrides':   [
        {
            'files': ['*.vue'],
            'rules': {
                indent: 'off',
            },
        },
    ],
};
