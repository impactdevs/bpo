<?php

namespace App\Imports;

use App\Models\DocumentData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocumentImport implements ToModel, WithHeadingRow
{
    protected $documentId;
    protected $documentName;

    public function __construct($documentId, $documentName)
    {
        $this->documentId = $documentId;
        $this->documentName = $documentName;
    }

    public function startRow(): int
    {
        return 2; // Start reading from the second row
    }

    public function model(array $row)
    {
        // Normalize headers to lowercase and trim spaces
        $row = array_change_key_case(array_map('trim', $row), CASE_LOWER);

        // Check if the row is empty (all fields are null or empty)
        if (
            empty($row['name']) &&
            empty($row['company']) &&
            empty($row['email']) &&
            empty($row['contact']) &&
            empty($row['location']) &&
            empty($row['position']) &&
            empty($row['employer']) &&
            empty($row['office_number'])
        ) {
            // Skip this row if all fields are empty
            return null;
        }

        return new DocumentData([
            'document_id'   => $this->documentId,
            'document_name' => $this->documentName,
            'name'          => $row['name'] ?? null,
            'company'       => $row['company'] ?? null,
            'email'         => $row['email'] ?? null,
            'contact'       => $row['contact'] ?? null,
            'location'      => $row['location'] ?? null,
            'position'      => $row['position'] ?? null,
            'employer'      => $row['employer'] ?? null,
            'office_number' => $row['office_number'] ?? null,
        ]);
    }
}
