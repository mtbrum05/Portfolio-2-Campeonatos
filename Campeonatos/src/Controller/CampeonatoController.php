<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;

/**
 * Campeonato Controller
 *
 *
 * @method \App\Model\Entity\Campeonato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CampeonatoController extends AppController
{
    public function index()
    {
        try {

            $campeonato = $this->paginate($this->Campeonato);
            $this->set([
                'data' => [
                    'campeonato' => $campeonato,
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
            $campeonato = $this->Campeonato->findById($id)->first();
            
            if(!$campeonato){
                $dados = ['campeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $this->set([
                'data' => [
                    'campeonato' => $campeonato,
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
        $data = $this->Campeonato->requestAdd($data);
        try {

            if ($this->request->is('post')) {
                $campeonato = $this->Campeonato->newEntity();
                $campeonato = $this->Campeonato->patchEntity($campeonato, $data);

                if ($this->Campeonato->save($campeonato)) {
                    $message = 'Salvo com sucesso!';
                } else {
                    $message = ['campeonato' => $campeonato->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'campeonato' => $campeonato,
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
            $campeonato = $this->Campeonato->findById($id)->first();
            
            if(!$campeonato){
                $dados = ['campeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }             
            $data = $this->Campeonato->requestEdit($data, $campeonato);
            if ($this->request->is(['put'])) {
                $campeonato = $this->Campeonato->patchEntity($campeonato, $data);
                if ($this->Campeonato->save($campeonato)) {
                    $message = 'Editado com sucesso!';
                } else {
                    $message = ['campeonato' => $campeonato->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'campeonato' => $campeonato,
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
            $campeonato = $this->Campeonato->findById($id)->first();
            
            if(!$campeonato){
                $dados = ['campeonato' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            } 

            if ($this->Campeonato->delete($campeonato)) {
                $message = 'Deletado com sucesso!';
            } else {
                $message = $campeonato->getErrors();
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
