<?php

namespace App\Controller;

use Exception;
use App\Controller\AppController;
use App\Model\Entity\TipoCampeonato;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;

/**
 * TipoCampeonato Controller
 *
 * @property \App\Model\Table\TipoCampeonatoTable $TipoCampeonato
 *
 * @method \App\Model\Entity\TipoCampeonato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipoCampeonatoController extends AppController
{

    public function index()
    {
        try {

            $tipoCampeonato = $this->paginate($this->TipoCampeonato);
            $this->set([
                'data' => [
                    'tipoCampeonato' => $tipoCampeonato,
                ],
                '_serialize' => ['data']
            ]);
        } catch (Exception $e) {
            return $this->ErrorHandler->errorHandler($e, 500);
        }
    }


    public function view($id = null)
    {

        try {
            $tipoCampeonato = $this->TipoCampeonato->findById($id)->first();
            
            if(!$tipoCampeonato){
                $dados = ['tipoCampeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $this->set([
                'data' => [
                    'tipoCampeonato' => $tipoCampeonato,
                ],
                '_serialize' => ['data']
            ]);
        } catch (NotFoundException $e) {
            return $this->ErrorHandler->errorHandler($e, 404);
        } catch (Exception $e) {
            return $this->ErrorHandler->errorHandler($e, 500);
        }
    }


    public function add()
    {


        $data = $this->request->getData();
        $data = $this->TipoCampeonato->requestAdd($data);

        try {

            if ($this->request->is('post')) {
                $tipoCampeonato = $this->TipoCampeonato->newEntity();
                $tipoCampeonato = $this->TipoCampeonato->patchEntity($tipoCampeonato, $data);

                if ($this->TipoCampeonato->save($tipoCampeonato)) {
                    $message = 'Salvo com sucesso!';
                } else {
                    $message = ['tipo_campeonato' => $tipoCampeonato->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'tipoCampeonato' => $tipoCampeonato,
                ],
                '_serialize' => ['data']
            ]);
        } catch (BadRequestException $e) { //400
            $dados = [
                "data"      => null,
                "message" => json_decode($e->getMessage(), true)
            ];

            return $this->response
                ->withStatus(400)
                ->withType('application/json')
                ->withStringBody(json_encode($dados));
        } catch (Exception $e) {
            return $this->ErrorHandler->errorHandler($e, 500);
        }
    }

    public function edit($id = null)
    {
        $data = $this->request->getData();

        try {
            $tipoCampeonato = $this->TipoCampeonato->findById($id)->first();
            
            if(!$tipoCampeonato){
                $dados = ['tipoCampeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            $data = $this->TipoCampeonato->requestEdit($data, $tipoCampeonato);
            if ($this->request->is(['put'])) {
                $tipoCampeonato = $this->TipoCampeonato->patchEntity($tipoCampeonato, $data);
                if ($this->TipoCampeonato->save($tipoCampeonato)) {
                    $message = 'Editado com sucesso!';
                } else {
                    $message = ['tipo_campeonato' => $tipoCampeonato->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'tipoCampeonato' => $tipoCampeonato,
                ],
                '_serialize' => ['data']
            ]);
        } catch (BadRequestException $e) { //400
            $dados = [
                "data"      => null,
                "message" => json_decode($e->getMessage(), true)
            ];

            return $this->response
                ->withStatus(400)
                ->withType('application/json')
                ->withStringBody(json_encode($dados));
        } catch (NotFoundException $e) {
            return $this->ErrorHandler->errorHandler($e, 404);
        } catch (Exception $e) {
            return $this->ErrorHandler->errorHandler($e, 500);
        }
    }

    public function delete($id = null)
    {
        try {

            $tipoCampeonato = $this->TipoCampeonato->findById($id)->first();
            
            if(!$tipoCampeonato){
                $dados = ['tipoCampeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            
            if ($this->TipoCampeonato->delete($tipoCampeonato)) {
                $message = 'Deletado com sucesso!';
            } else {
                $message = $tipoCampeonato->getErrors();
            }
            $this->set([
                'data' => [
                    'message' => $message,
                ],
                '_serialize' => ['data']
            ]);
        } catch (NotFoundException $e) {
            return $this->ErrorHandler->errorHandler($e, 404);
        } catch (Exception $e) {
            if($e->getCode() == 23000){
                return $this->ErrorHandler->errorHandlerConstraintViolation($e, 400);
            }
            return $this->ErrorHandler->errorHandler($e, 500);
        }
    }
}
