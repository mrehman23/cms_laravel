<?php
namespace App\Http\Services;

class RouterService {

    public function redirect($entity, $error, $message)
    {
        if($error)
            return $this->redirectBack($error, $message);

        return redirect()->route($entity)->with([
            $error ? 'error' : 'success' => $message
        ]);
    }

    public function redirectBack($error, $message)
    {
        return redirect()->back()->with([
            $error ? 'error' : 'success' => $message
        ]);
    }

    public function redirectWithParams($entity, $params, $error, $message)
    {
        return redirect()->route($entity, $params)->with([
            $error ? 'error' : 'success' => $message
        ]);
    }
}
