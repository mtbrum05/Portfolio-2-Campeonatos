<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;

/**
 * LogCampeonato Controller
 *
 * @property \App\Model\Table\LogCampeonatoTable $LogCampeonato
 *
 * @method \App\Model\Entity\LogCampeonato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogCampeonatoController extends AppController
{
    public function index()
    {
        try {

            $logCampeonato = $this->paginate($this->LogCampeonato);
            $this->set([
                'data' => [
                    'logCampeonato' => $logCampeonato,
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
            $logCampeonato = $this->LogCampeonato->findById($id)->first();
            
            if(!$logCampeonato){
                $dados = ['logCampeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $this->set([
                'data' => [
                    'logCampeonato' => $logCampeonato,
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
        $data = $this->LogCampeonato->requestAdd($data);
        try {

            if ($this->request->is('post')) {
                $logCampeonato = $this->LogCampeonato->newEntity();
                $logCampeonato = $this->LogCampeonato->patchEntity($logCampeonato, $data);

                if ($this->LogCampeonato->save($logCampeonato)) {
                    $message = 'Salvo com sucesso!';
                } else {
                    $message = ['logCampeonato' => $logCampeonato->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'logCampeonato' => $logCampeonato,
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
            $logCampeonato = $this->LogCampeonato->findById($id)->first();
            
            if(!$logCampeonato){
                $dados = ['logCampeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            } 
            $data = $this->LogCampeonato->requestEdit($data, $logCampeonato);
            if ($this->request->is(['put'])) {
                $logCampeonato = $this->LogCampeonato->patchEntity($logCampeonato, $data);
                if ($this->LogCampeonato->save($logCampeonato)) {
                    $message = 'Editado com sucesso!';
                } else {
                    $message = ['logCampeonato' => $logCampeonato->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'logCampeonato' => $logCampeonato,
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
            $logCampeonato = $this->LogCampeonato->findById($id)->first();
            
            if(!$logCampeonato){
                $dados = ['logCampeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            } 

            if ($this->LogCampeonato->delete($logCampeonato)) {
                $message = 'Deletado com sucesso!';
            } else {
                $message = $logCampeonato->getErrors();
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
