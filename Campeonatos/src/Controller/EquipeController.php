<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\BadRequestException;

/**
 * Equipe Controller
 *
 * @property \App\Model\Table\EquipeTable $Equipe
 *
 * @method \App\Model\Entity\Equipe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EquipeController extends AppController
{
    public function index()
    {
        try {

            $equipe = $this->paginate($this->Equipe);
            $this->set([
                'data' => [
                    'equipe' => $equipe,
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
            $equipe = $this->Equipe->findById($id)->first();
            
            if(!$equipe){
                $dados = ['equipe' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $this->set([
                'data' => [
                    'equipe' => $equipe,
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
        $data = $this->Equipe->requestAdd($data);

        try {

            if ($this->request->is('post')) {
                $equipe = $this->Equipe->newEntity();
                $equipe = $this->Equipe->patchEntity($equipe, $data);

                if ($this->Equipe->save($equipe)) {
                    $message = 'Salvo com sucesso!';
                } else {
                    $message = ['equipe' => $equipe->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'equipe' => $equipe,
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
            $equipe = $this->Equipe->findById($id)->first();
            
            if(!$equipe){
                $dados = ['equipe' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            $data = $this->Equipe->requestEdit($data, $equipe);
            if ($this->request->is(['put'])) {
                $equipe = $this->Equipe->patchEntity($equipe, $data);
                if ($this->Equipe->save($equipe)) {
                    $message = 'Editado com sucesso!';
                } else {
                    $message = ['equipe' => $equipe->getErrors()];
                    throw new BadRequestException(json_encode($message));
                }
            }
            $this->set([
                'data' => [
                    'message' => $message,
                    'equipe' => $equipe,
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

            $equipe = $this->Equipe->findById($id)->first();
            
            if(!$equipe){
                $dados = ['equipe' => ['_error' => 'Registro não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            if ($this->Equipe->delete($equipe)) {
                $message = 'Deletado com sucesso!';
            } else {
                $dados = ['equipe' => ['_error' => 'Impossivel deletar, pois pode gerar dados orfãos.']];
                throw new BadRequestException(json_encode($dados));
                
            }
            $this->set([
                'data' => [
                    'message' => $message,
                ],
                '_serialize' => ['data']
            ]);
        } catch (BadRequestException $e) {
            return $this->ErrorHandler->errorHandler($e, 400);
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
