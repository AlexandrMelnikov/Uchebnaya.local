<?php

use yii\db\Migration;

class m160816_211657_create_tables extends Migration
{
    public function up()
    {
$tableOptions = null;
    if ($this->db->driverName === 'mysql') {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
    }
    $this->createTable('{{%user}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'username' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'password' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'auth_key' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'token' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'email' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL'
    ], $tableOptions);
    $this->createIndex('username', '{{%user}}', 'username', true);
    $this->createTable('{{%category}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'name' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'description' => \yii\db\mysql\Schema::TYPE_STRING
    ], $tableOptions);
    $this->createIndex('name', '{{%category}}', 'name', true);
    $this->createTable('{{%post}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'title' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'content' => \yii\db\mysql\Schema::TYPE_TEXT . ' NOT NULL',
        'category_id' => \yii\db\mysql\Schema::TYPE_SMALLINT . ' unsigned NOT NULL',
        'status' => \yii\db\mysql\Schema::TYPE_SMALLINT . ' NOT NULL',
        'created_at' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL',
        'updated_at' => \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL'
    ], $tableOptions);
    $this->createIndex('status', '{{%post}}', 'status');
    $this->createTable('{{%comment}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'author' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'email' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'url' => \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL',
        'content' => \yii\db\mysql\Schema::TYPE_TEXT . ' NOT NULL',
        'status' => \yii\db\mysql\Schema::TYPE_SMALLINT . ' NOT NULL'
    ], $tableOptions);
    $this->createIndex('status', '{{%comment}}', 'status');
    $this->execute($this->addUserSql());
    }
    private function addUserSql()
    {
        $password = Yii::$app->security->generatePasswordHash('admin');
        $auth_key = Yii::$app->security->generateRandomString();
        $token = Yii::$app->security->generateRandomString() . '_' . time();
        return "INSERT INTO {{%user}} (`username`, `email`, `password`, `auth_key`, `token`) VALUES ('admin', 'admin@Uchebnaya.local', '$password', '$auth_key', '$token')";
    }
    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%comment}}');
        $this->dropTable('{{%category}}');
        echo "m160816_211657_create_tables cannot be reverted.\n";
        return false;
    }


    // Use safeUp/safeDown to run migration code within a transaction
  /*  public function safeUp()
    {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
    }
    $this->createTable('{{%user}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'username' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'password' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'auth_key' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'token' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'email' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL'
    ], $tableOptions);
    $this->createIndex('username', '{{%user}}', 'username', true);
    $this->createTable('{{%category}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'name' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'description' => \yii\db\mysql\Schema::TYPE_STRING
    ], $tableOptions);
    $this->createIndex('name', '{{%category}}', 'name', true);
    $this->createTable('{{%post}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'title' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'content' => \yii\db\mysql\Schema::TYPE_TEXT . 'NOT NULL',
        'category_id' => \yii\db\mysql\Schema::TYPE_SMALLINT . 'unsigned NOT NULL',
        'status' => \yii\db\mysql\Schema::TYPE_SMALLINT . 'NOT NULL',
        'created_at' => \yii\db\mysql\Schema::TYPE_INTEGER . 'NOT NULL',
        'updated_at' => \yii\db\mysql\Schema::TYPE_INTEGER . 'NOT NULL'
    ], $tableOptions);
    $this->createIndex('status', '{{%post}}', 'status');
    $this->createTable('{{%comment}}', [
        'id' => \yii\db\mysql\Schema::TYPE_PK,
        'author' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'email' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'url' => \yii\db\mysql\Schema::TYPE_STRING . 'NOT NULL',
        'content' => \yii\db\mysql\Schema::TYPE_TEXT . 'NOT NULL',
        'status' => \yii\db\mysql\Schema::TYPE_SMALLINT . 'NOT NULL'
    ], $tableOptions);
    $this->createIndex('status', '{{%comment}}', 'status');
    $this->execute($this->addUserSql());
}
    private function addUserSql()
    {
        $password = Yii::$app->security->generatePasswordHash('admin');
        $auth_key = Yii::$app->security->generateRandomString();
        $token = Yii::$app->security->generateRandomString() . '_' . time();
        return "INSERT INTO {{%user}} (`username`, `email`, `password`, `auth_key`, `token`) VALUES ('admin', 'admin@Uchebnaya.local', '$password', '$auth_key', '$token')";
    }


    public function safeDown()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%comment}}');
        $this->dropTable('{{%category}}');
        echo "m160816_211657_create_tables cannot be reverted.\n";
        return false;
    }*/

}
