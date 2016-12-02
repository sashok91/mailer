<?php

namespace App\Repositories;


use App\Models\Mailing;

class MailingRepository implements MailingRepositoryInterface
{
    protected $mailings;

    public function __construct(Mailing $mailings)
    {
        $this->mailings = $mailings;
    }

    public function all($columns = array('*'))
    {
        return $this->mailings->all();
    }

    public function create(array $data)
    {
        $dataForSave = [
            'name' => trim($data['name']),
            'email_theme' => trim($data['email_theme']),
            'email_text' => trim($data['email_text']),
            'status' =>  Mailing::STATUS_DRAFT
        ];
        if (array_key_exists('scheduled_date_html', $data) && strlen($data['scheduled_date_html'])){
            $dataForSave['scheduled_date_html'] = trim($data['scheduled_date_html']);
        }
        $mailing = $this->mailings->create($dataForSave);
        $mailing->mailingGroups()->sync($data['mailing_groups']);
        return $mailing;
    }

    public function update($id, array $data)
    {
        $mailing = $this->find($id);
        $mailing->update([
            'name' => trim($data['name']),
            'email_theme' => trim($data['email_theme']),
            'email_text' => trim($data['email_text']),
            'scheduled_date_html' => trim($data['scheduled_date_html']),
            'status' =>  Mailing::STATUS_DRAFT
        ]);
        $mailing->mailingGroups()->sync($data['mailing_groups']);
        return $mailing;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function find($id, $columns = array('*'))
    {
        return $this->mailings->find($id, $columns);
    }

    public function allSent()
    {
        return $this->mailings->where('status', Mailing::STATUS_SENT)->get();
    }

    public function allDraft()
    {
        return $this->mailings->where('status', Mailing::STATUS_DRAFT)->get();
    }
}