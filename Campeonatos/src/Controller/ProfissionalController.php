<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;


/**
 * Profissional Controller
 *
 * @property \App\Model\Table\ProfissionalTable $Profissional
 *
 * @method \App\Model\Entity\Profissional[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfissionalController extends AppController
{

    public function index()
    {
        try {

            $profissionais = $this->paginate($this->Profissional);
            $this->set([
                'data' => [
                    'profissionais' => $profissionais,
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
            $profissional = $this->Profissional->findById($id)->first();
            
            if(!$profissional){
                $dados = ['profissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $this->set([
                'data' => [
                    'profissional' => $profissional,
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
        $data = $this->Profissional->requestAdd($data);
        try {

            if ($this->request->is('post')) {
                $profissional = $this->Profissional->newEntity();
                $profissional = $this->Profissional->patchEntity($profissional, $data);

                if ($this->Profissional->save($profissional)) {
                    $message = 'Salvo com sucesso!';
                } else {
                    $message = ['profissional' => $profissional->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'profissional' => $profissional,
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
            $profissional = $this->Profissional->get($id);
            
            $data = $this->Profissional->requestEdit($data, $profissional);
            if ($this->request->is(['put'])) {
                $profissional = $this->Profissional->patchEntity($profissional, $data);
                if ($this->Profissional->save($profissional)) {
                    $message = 'Editado com sucesso!';
                } else {
                    $message = ['profissional' => $profissional->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'profissional' => $profissional,
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
            $profissional = $this->Profissional->findById($id)->first();
            
            if(!$profissional){
                $dados = ['profissional' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            } 

            if ($this->Profissional->delete($profissional)) {
                $message = 'Deletado com sucesso!';
            } else {
                $message = $profissional->getErrors();
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
