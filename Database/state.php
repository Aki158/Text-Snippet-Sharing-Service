<?php

return [
    'User' => [
        'userID' => [
            'dataType' => 'INT',
            'constraints' => 'AUTO_INCREMENT',
            'primaryKey' => true,
            'nullable' => false,
        ],
        'username' => [
            'dataType' => 'VARCHAR(255)',
            'nullable' => false,
        ],
        'email' => [
            'dataType' => 'VARCHAR(255)',
            'nullable' => false,
        ],
        'password' => [
            'dataType' => 'VARCHAR(255)',
            'nullable' => false,
        ],
        'email_confirmed_at' => [
            'dataType' => 'VARCHAR(255)',
            'nullable' => true,
        ],
        'created_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
        'updated_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ]
    ],
    'Post' => [
        'postID' => [
            'dataType' => 'INT',
            'constraints' => 'AUTO_INCREMENT',
            'primaryKey' => true,
            'nullable' => false,
        ],
        'title' => [
            'dataType' => 'VARCHAR(255)',
            'nullable' => false,
        ],
        'content' => [
            'dataType' => 'TEXT',
            'nullable' => false,
        ],
        'created_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
        'updated_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
        'userID' => [
            'dataType' => 'INT',
            'foreignKey' => [
                'referenceTable' => 'User',
                'referenceColumn' => 'userID',
                'onDelete' => 'CASCADE'
            ],
            'nullable' => false,
        ]
    ],
    'Comment' => [
        'commentID' => [
            'dataType' => 'INT',
            'constraints' => 'AUTO_INCREMENT',
            'primaryKey' => true,
            'nullable' => false,
        ],
        'commentText' => [
            'dataType' => 'VARCHAR(255)',
            'nullable' => false,
        ],
        'created_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
        'updated_at' => [
            'dataType' => 'DATETIME',
            'nullable' => false,
        ],
        'userID' => [
            'dataType' => 'INT',
            'foreignKey' => [
                'referenceTable' => 'User',
                'referenceColumn' => 'userID',
                'onDelete' => 'CASCADE'
            ],
            'nullable' => false,
        ],
        'postID' => [
            'dataType' => 'INT',
            'foreignKey' => [
                'referenceTable' => 'Post',
                'referenceColumn' => 'postID',
                'onDelete' => 'CASCADE'
            ],
            'nullable' => false,
        ]
    ],
    'PostLike' => [
        'userID' => [
            'dataType' => 'INT',
            'foreignKey' => [
                'referenceTable' => 'User',
                'referenceColumn' => 'userID',
                'onDelete' => 'CASCADE'
            ],
            'primaryKey' => true,
            'nullable' => false,
        ],
        'postID' => [
            'dataType' => 'INT',
            'foreignKey' => [
                'referenceTable' => 'Post',
                'referenceColumn' => 'postID',
                'onDelete' => 'CASCADE'
            ],
            'primaryKey' => true,
            'nullable' => false,
        ]
    ],
    'CommentLike' => [
        'userID' => [
            'dataType' => 'INT',
            'foreignKey' => [
                'referenceTable' => 'User',
                'referenceColumn' => 'userID',
                'onDelete' => 'CASCADE'
            ],
            'primaryKey' => true,
            'nullable' => false,
        ],
        'commentID' => [
            'dataType' => 'INT',
            'foreignKey' => [
                'referenceTable' => 'Comment',
                'referenceColumn' => 'commentID',
                'onDelete' => 'CASCADE'
            ],
            'primaryKey' => true,
            'nullable' => false,
        ]
    ]
];
