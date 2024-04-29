<?php

namespace App\Repositories;

use App\Interfaces\FaqRepositoryInterface;
use App\Models\Faq;


class FaqRepository implements FaqRepositoryInterface
{
    public function store($request)
    {
        $user = Faq::create($request);
        return $user;
    }

    public function get()
    {
        return Faq::where('faq_type', 1)->get();
    }

    public function getData($faq_type)
    {
        return Faq::where('id', $faq_type)->first();
    }

    public function getUserFaq()
    {
        return Faq::where('faq_type', 2)->get();
    }



    public function update($id, $request)
    {
        return Faq::find($id)->update($request);
    }

    public function delete($id)
    {
        $faqDelete =  Faq::find($id);
        return  $faqDelete->delete();
    }
}
