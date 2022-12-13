<?php

namespace App\Http\Controllers;

use App\Mail\SendSolicitacaoStatus;
use App\Models\Avaliacao;
use App\Models\Solicitacao;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AvaliacaoController extends Controller
{
    public function aprovarSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::find($request->solicitacao_id);
        $avaliador = User::find(Auth::user()->id);
        Avaliacao::where('solicitacao_id', $solicitacao->id)->where('user_id', '!=', $avaliador->id)->delete();
        $avaliacao = Avaliacao::find($request->avaliacao_id);
        $avaliacao->status = 'aprovada';
        $solicitacao->status = 'avaliado';
        $solicitacao->update();
        $avaliacao->update();
        //Criação da licença
        $licenca = new Licenca();
        $licenca->inicio = $request->inicio;
        $licenca->fim = $request->fim;
        $licenca->codigo = strtoupper(hash($solicitacao->id, $request->inicio.$request->fim));
        $licenca->avaliacao_id = $avaliacao->id;
        $licenca->save();

        Mail::to($solicitacao->responsavel->contato->email)->send(new SendSolicitacaoStatus($solicitacao->responsavel, $avaliacao));

        return redirect(route('solicitacao.avaliador.index'));
    }

    public function aprovarPendenciaSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::find($request->solicitacao_id);
        $avaliador = User::find(Auth::user()->id);
        Avaliacao::where('solicitacao_id', $solicitacao->id)->where('user_id', '!=', $avaliador->id)->delete();
        $avaliacao = $solicitacao->avaliacao->first();
        $avaliacao->status = 'aprovadaPendencia';
        $avaliacao->parecer = $request->parecer;
        $solicitacao->status = 'avaliado';
        $solicitacao->update();
        $avaliacao->update();

        Mail::to($solicitacao->responsavel->contato->email)->send(new SendSolicitacaoStatus($solicitacao->responsavel, $avaliacao));

        return redirect(route('solicitacao.avaliador.index'));
    }

    public function reprovarSolicitacao(Request $request)
    {
        $solicitacao = Solicitacao::find($request->solicitacao_id);
        $avaliador = User::find($request->avaliador_id);
        Avaliacao::where('solicitacao_id', $solicitacao->id)->where('user_id', '!=', $avaliador->id)->delete();
        $avaliacao = $solicitacao->avaliacao->first();
        $avaliacao->status = 'reprovada';
        $avaliacao->parecer = $request->parecer;
        $solicitacao->status = 'avaliado';
        $solicitacao->update();
        $avaliacao->update();

        Mail::to($solicitacao->responsavel->contato->email)->send(new SendSolicitacaoStatus($solicitacao->responsavel, $avaliacao));

        return redirect(route('solicitacao.avaliador.index'));
    }
}
