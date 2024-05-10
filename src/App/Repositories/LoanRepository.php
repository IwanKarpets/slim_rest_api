<?php

namespace App\Repositories;

use App\Database;
use PDO;

class LoanRepository
{
    public function __construct(private Database $database)
    {
    }

    public function getAll($startDate = null, $endDate = null, $minAmount = null, $maxAmount = null): array
    {
        $pdo = $this->database->getConnection();
        $sql = "SELECT * FROM loans WHERE 1=1";

        $params = [];
        if ($startDate) {
            $sql .= " AND created_at >= :start_date";
            $params['start_date'] = $startDate;
        }
        if ($endDate) {
            $sql .= " AND created_at <= :end_date";
            $params['end_date'] = $endDate;
        }
        if ($minAmount) {
            $sql .= " AND amount >= :min_amount";
            $params['min_amount'] = $minAmount;
        }
        if ($maxAmount) {
            $sql .= " AND amount <= :max_amount";
            $params['max_amount'] = $maxAmount;
        }


        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);


        $loans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $loans;
    }

    public function getById(int $id)
    {
        $sql = 'SELECT *
                FROM loans
                WHERE id = :id';

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): string
    {
        $sql = 'INSERT INTO loans (name, amount)
                VALUES (:name, :amount)';

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);

        $stmt->bindValue(':amount', $data['amount'], PDO::PARAM_INT);

        $stmt->execute();

        return $pdo->lastInsertId();
    }

    public function update(int $id, array $data): int
    {
        $sql = 'UPDATE loans
                SET name = :name,
                    amount = :amount
                WHERE id = :id';

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);

        $stmt->bindValue(':amount', $data['amount'], PDO::PARAM_INT);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = 'DELETE FROM loans
                WHERE id = :id';

        $pdo = $this->database->getConnection();

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}
