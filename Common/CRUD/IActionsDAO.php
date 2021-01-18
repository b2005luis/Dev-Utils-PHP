<?php

/**
 * Interface for default actions for data access operations
 * @author Luis Alberto Batista Pedroso
 */
interface IActionsDAO {

    public function Create(object $Object, DatabaseConnect $Server);

    public function Update(object $Object, DatabaseConnect $Server);

    public function Delete(int $Id, DatabaseConnect $Server);

    public function ListAllRecords(DatabaseConnect $Server);

    public function GetRecordById(object $Object, DatabaseConnect $Server);

    public function GetRecordByCode(object $Object, DatabaseConnect $Server);

    public function ListRecordsByDescription(object $Object, DatabaseConnect $Server);
}
