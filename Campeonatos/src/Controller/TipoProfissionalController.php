<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;

/**
 * TipoProfissional Controller
 *
 * @property \App\Model\Table\TipoProfissionalTable $TipoProfissional
 *
 * @method \App\Model\Entity\TipoProfissional[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipoProfissionalController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        try {

            $tipoProfissional = $this->paginate($this->TipoProfissional);
            $this->set([
                'data' => [
                    'tipoProfissional' => $tipoProfissional,
                ],
                '_serialize' => ['data']
            ]);
        } catch (Exception $e) {
            return $this->ErrorHandler->errorHandler($e, 500);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Tipo Profissional id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        try {
            $tipoProfissional = $this->TipoProfissional->findById($id)->first();
            
            if(!$tipoProfissional){
                $dados = ['tipoProfissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $this->set([
                'data' => [
                    'tipoProfissional' => $tipoProfissional,
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
        $data = $this->TipoProfissional->requestAdd($data);

        try {

            if ($this->request->is('post')) {
                $tipoProfissional = $this->TipoProfissional->newEntity();
                $tipoProfissional = $this->TipoProfissional->patchEntity($tipoProfissional, $data);

                if ($this->TipoProfissional->save($tipoProfissional)) {
                    $message = 'Salvo com sucesso!';
                } else {
                    $message = ['tipo_profissional' => $tipoProfissional->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'tipoProfissional' => $tipoProfissional,
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

    /**
     * Edit method
     *
     * @param string|null $id Tipo Profissional id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->request->getData();

        try {
            $tipoProfissional = $this->TipoProfissional->findById($id)->first();
            
            if(!$tipoProfissional){
                $dados = ['tipoProfissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            $data = $this->TipoProfissional->requestEdit($data, $tipoProfissional);
            if ($this->request->is(['put'])) {
                $tipoProfissional = $this->TipoProfissional->patchEntity($tipoProfissional, $data);
                if ($this->TipoProfissional->save($tipoProfissional)) {
                    $message = 'Editado com sucesso!';
                } else {
                    $message = ['tipo_profissional' => $tipoProfissional->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'tipoProfissional' => $tipoProfissional,
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

            $tipoProfissional = $this->TipoProfissional->findById($id)->first();
            
            if(!$tipoProfissional){
                $dados = ['tipoProfissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            if ($this->TipoProfissional->delete($tipoProfissional)) {
                $message = 'Deletado com sucesso!';
            } else {
                $message = $tipoProfissional->getErrors();
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
