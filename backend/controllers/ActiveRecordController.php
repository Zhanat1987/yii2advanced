<?php
namespace backend\controllers;

use Yii;
use common\components\MyController;
use common\myhelpers\Debugger;

/**
 * ActiveRecord controller
 */
class ActiveRecordController extends MyController
{

	public function actionIndex()
	{
//        $primaryConnection = Yii::$app->db;
//        $secondaryConnection = Yii::$app->secondDb;
//        Debugger::margin();
//        Debugger::debug($primaryConnection);
//        Debugger::debug($secondaryConnection);

//        $command = $connection->createCommand('SELECT * FROM test');
//        $tests = $command->queryAll();
//        Debugger::margin();
//        Debugger::debug($tests);
//        $command = $connection->createCommand('SELECT * FROM test WHERE id=1');
//        $tests = $command->queryOne();
//        Debugger::margin();
//        Debugger::debug($tests);
//        $command = $connection->createCommand('SELECT title FROM test');
//        $titles = $command->queryColumn();
//        Debugger::margin();
//        Debugger::debug($titles);
//        $command = $connection->createCommand('SELECT COUNT(*) FROM test');
//        $testCount = $command->queryScalar();
//        Debugger::margin();
//        Debugger::debug($testCount);

//        $command = $connection->createCommand('UPDATE test SET title="update" WHERE id=1');
//        $command->execute();

//        // INSERT
//        $connection->createCommand()->insert('test', [
//            'title' => 'Sam',
//            'text' => 30,
//        ])->execute();
//
//        // INSERT multiple rows at once
//        $connection->createCommand()->batchInsert('test', ['title', 'text'], [
//            ['Tom', 30],
//            ['Jane', 20],
//            ['Linda', 25],
//        ])->execute();
//
//        // UPDATE
//        $connection->createCommand()->update('test', ['text' => 'update text'],
//            'title = "update"')->execute();
//
//        // DELETE
//        $connection->createCommand()->delete('test', 'id = 2')->execute();

//        $column = 'title';
//        $table = 'test';
//        $sql = "SELECT COUNT([[$column]]) FROM {{{$table}}}";
//        $command = $connection->createCommand($sql);
//        $rowCount = $command->queryScalar();
//        Debugger::margin();
//        Debugger::debug($rowCount);
//        Debugger::debug($command->pdoStatement->queryString);
//
//        $column = 'title';
//        $table = 'test';
//        $column = $connection->quoteColumnName($column);
//        $table = $connection->quoteTableName($table);
//        $sql = "SELECT COUNT($column) FROM $table";
//        $command = $connection->createCommand($sql);
//        $rowCount = $command->queryScalar();
//        Debugger::margin();
//        Debugger::debug($rowCount);
//        Debugger::debug($command->pdoStatement->queryString);

//        $_GET['id'] = 1;
//        $command = $connection->createCommand('SELECT * FROM test WHERE id=:id');
//        $command->bindValue(':id', $_GET['id']);
//        $test = $command->query();
//        Debugger::margin();
//        Debugger::debug($test);
//        Debugger::debug($command->pdoStatement->queryString);

//        $command = $connection->createCommand('DELETE FROM test WHERE id=:id');
//        $command->bindParam(':id', $id);
//        $id = 3;
//        $command->execute();
//        $id = 6;
//        $command->execute();

//        $column = 'title';
//        $table = 'test';
//        $column2 = 'id';
//        $sql1 = "UPDATE {{{$table}}} SET [[$column]] = 'TEST' WHERE [[$column2]] = 5";
//        $sql2 = "UPDATE {{{$table}}} SET [[$column]] = 'TEST' WHERE [[$column2]] = 7";
//        $transaction = $connection->beginTransaction();
//        try {
//            $connection->createCommand($sql1)->execute();
//            $connection->createCommand($sql2)->execute();
//            // ... executing other SQL statements ...
//            $transaction->commit();
//        } catch(Exception $e) {
//            $transaction->rollBack();
//        }

//        $column = 'text';
//        $table = 'test';
//        $column2 = 'id';
//        $sql1 = "UPDATE {{{$table}}} SET [[$column]] = 'TEST' WHERE [[$column2]] = 5";
//        $sql2 = "UPDATE {{{$table}}} SET [[$column]] = 'TEST' WHERE [[$column2]] = 7";
//        // outer transaction
//        $transaction1 = $connection->beginTransaction();
//        try {
//            $connection->createCommand($sql1)->execute();
//
//            // inner transaction
//            $transaction2 = $connection->beginTransaction();
//            try {
//                $connection->createCommand($sql2)->execute();
//                $transaction2->commit();
//            } catch (Exception $e) {
//                $transaction2->rollBack();
//            }
//
//            $transaction1->commit();
//        } catch (Exception $e) {
//            $transaction1->rollBack();
//        }

//        $schema = $connection->getSchema();
//        Debugger::margin();
//        Debugger::debug($schema);

//        $schema = $connection->getSchema();
//        $tables = $schema->getTableNames();
//        Debugger::margin();
//        Debugger::debug($tables);

//        try {
//            // CREATE TABLE
//            $connection->createCommand()->createTable('tbl_post', [
//                'id' => 'pk',
//                'title' => 'string',
//                'text' => 'text',
//            ]);
//        } catch (\yii\db\Exception $e) {
//            Debugger::margin();
//            Debugger::debug($e);
//        }
//
//        $schema = $connection->getSchema();
//        $tables = $schema->getTableNames();
//        Debugger::margin();
//        Debugger::debug($tables);

        return $this->render('index', [

        ]);
	}

}
