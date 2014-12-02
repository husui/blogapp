<?php
App::uses('AppModel', 'Model');

/**
 * Post Model
 *
 * ブログ記事要モデルです
 *
 * @copyright php_ci_book
 * @link http://gitihub/husui/blogapp/blob/master/app/Model/Post.php
 * @since 1.0
 * @author hideaki.usui <t4o0m0@gmail.com>
 *
 */
class Post extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = [
        'title' => [
            'notEmpty' => [
                'rule' => ['notEmpty'],
                'message' => 'タイトルは必須入力です',
            ],
            'maxLength' => [
                'rule' => ['maxLength', '255'],
                'message' => 'タイトルは255文字以内で入力してください',
            ],
        ],
    ];

    public $actsAs = ['Containable'];
    public $recursive = -1;
    public $belongsTo = [
        'Author' => [
            'className' => 'Users.User',
            'foreignKey' => 'author_id'
        ]
    ];

    public function getPaginateSettings($username) {
        return [
            'limit' => 5,
            'order' => ['Post.id' => 'desc'],
            'contain' => ['Author'],
            'conditions' => ['Author.username' => $username],
        ];
    }
}
