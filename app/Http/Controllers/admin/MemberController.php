<?php

namespace App\Http\Controllers\admin;

use App\DataTransferObject\MemberDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Resources\MemberResource;
use App\Services\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MemberController extends Controller
{
    public function __construct(){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, MemberService $memberService): \Inertia\Response
    {
        return Inertia::render('admin/members/Index', [
            'members' => MemberResource::collection($memberService->collection()),
        ]);
    }

    public function renderForm() : \Inertia\Response {
        return Inertia::render('admin/members/Add', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request, MemberService $memberService)
    {
        $memberService->store(MemberDTO::fromRequest($request), []);
        return Redirect::route('membres.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
