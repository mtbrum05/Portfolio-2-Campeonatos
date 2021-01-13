<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;

/**
 * EquipeProfissional Controller
 *
 * @property \App\Model\Table\EquipeProfissionalTable $EquipeProfissional
 *
 * @method \App\Model\Entity\EquipeProfissional[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EquipeProfissionalController extends AppController
{
    public function index()
    {
        try {

            $equipeProfissional = $this->paginate($this->EquipeProfissional);
            $this->set([
                'data' => [
                    'equipeProfissional' => $equipeProfissional,
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
            $equipeProfissional = $this->EquipeProfissional->findById($id)->first();
            
            if(!$equipeProfissional){
                $dados = ['equipeProfissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $this->set([
                'data' => [
                    'equipeProfissional' => $equipeProfissional,
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
        $data = $this->EquipeProfissional->requestAdd($data);
        try {

            if ($this->request->is('post')) {
                $equipeProfissional = $this->EquipeProfissional->newEntity();
                $equipeProfissional = $this->EquipeProfissional->patchEntity($equipeProfissional, $data);

                if ($this->EquipeProfissional->save($equipeProfissional)) {
                    $message = 'Salvo com sucesso!';
                } else {
                    $message = ['equipeProfissional' => $equipeProfissional->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'equipeProfissional' => $equipeProfissional,
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
            $equipeProfissional = $this->EquipeProfissional->findById($id)->first();
            
            if(!$equipeProfissional){
                $dados = ['equipeProfissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            } 
            $data = $this->EquipeProfissional->requestEdit($data, $equipeProfissional);
            if ($this->request->is(['put'])) {
                $equipeProfissional = $this->EquipeProfissional->patchEntity($equipeProfissional, $data);
                if ($this->EquipeProfissional->save($equipeProfissional)) {
                    $message = 'Editado com sucesso!';
                } else {
                    $message = ['equipeProfissional' => $equipeProfissional->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'equipeProfissional' => $equipeProfissional,
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
            $equipeProfissional = $this->EquipeProfissional->findById($id)->first();
            
            if(!$equipeProfissional){
                $dados = ['equipeProfissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            } 

            if ($this->EquipeProfissional->delete($equipeProfissional)) {
                $message = 'Deletado com sucesso!';
            } else {
                $message = $equipeProfissional->getErrors();
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
