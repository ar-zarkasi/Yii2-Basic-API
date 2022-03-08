<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m220308_040032_auth_app
 */
class m220308_040032_auth_app extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users',[
            'uid'=>Schema::TYPE_UPK,
            'email'=>$this->string(255),
            'phone'=>$this->string(16),
            'fullname'=>$this->string(120),
            'token'=>$this->string(128),
            'token_expiry'=>$this->dateTime(),
            'password'=>$this->text()->notNull(),
            'is_active'=>$this->boolean()->defaultValue(0),
            'created_date'=>$this->dateTime(),
            'updated_date'=>$this->dateTime()->defaultValue(NULL),
        ]);
        $this->addPrimaryKey('PK_USER','users','uid');
        $this->createIndex('IDX_USERS_MAIL','users','email',true);
        $this->createIndex('IDX_USERS_PHONE','users','phone',true);
        $this->createIndex('IDX_USERS','users',['email','phone'],false);
        $this->createIndex('IDX_TOKEN_USER_UNIQUE','users','token',true);
        $this->createIndex('IDX_TOKEN_USER','users','token',false);
        $this->createIndex('IDX_TOKEN_USER_EXPIRED','users','token_expiry',false);
        $this->addCommentOnColumn('users','is_active','0 = inactive, 1 = active, 2 = soft delete, 3 = banned');
        $this->addCommentOnColumn('users','token_expiry','Expired Time Token');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220308_040032_auth_app cannot be reverted.\n";

        return false;
    }
    */
}
