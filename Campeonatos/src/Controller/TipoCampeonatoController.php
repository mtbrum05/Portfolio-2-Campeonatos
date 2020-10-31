<?php
namespace App\Controller;

use Exception;
use App\Controller\AppController;
use App\Model\Entity\TipoCampeonato;
use Cake\Http\Exception\NotFoundException;

/**
 * TipoCampeonato Controller
 *
 * @property \App\Model\Table\TipoCampeonatoTable $TipoCampeonato
 *
 * @method \App\Model\Entity\TipoCampeonato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipoCampeonatoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        try{
            
        $tipoCampeonato = $this->paginate($this->TipoCampeonato);

        $this->set([
            'data' => [
                'tipoCampeonato' => $tipoCampeonato,
            ],
            '_serialize' => ['data']        
            ]);
        } catch (Exception $e){
            return $this->ErrorHandler->errorHandler($e, 500);
        }
        
    }


    public function view($id = null)
    {
            $tipoCampeonato = $this->TipoCampeonato->get($id);

            $this->set([
                'data' => [
                    'tipoCampeonato' => $tipoCampeonato,
                ],
                '_serialize' => ['data']        
                ]);    
        
    }


    public function add()
    {

        $data = $this->request->getData();
        $data['data_criacao'] = date('Y-m-d H:i:s');
        if ($this->request->is('post')) {
            $tipoCampeonato = $this->TipoCampeonato->newEntity();
            $tipoCampeonato = $this->TipoCampeonato->patchEntity($tipoCampeonato, $data);
            if ($this->TipoCampeonato->save($tipoCampeonato)) {
                $message = 'Saved';
            } else {
                $message = $tipoCampeonato->getErrors();
            }
        }
        $this->set([
            'data' => [
                'message' => $message,
                'tipoCampeonato' => $tipoCampeonato,
            ],
            '_serialize' => ['data']
        ]);
    }

    public function edit($id = null)
    {
        $data = $this->request->getData();
        $tipoCampeonato = $this->TipoCampeonato->get($id);
        if ($this->request->is(['put'])) {
            $tipoCampeonato = $this->TipoCampeonato->patchEntity($tipoCampeonato,$data);
            if ($this->TipoCampeonato->save($tipoCampeonato)) {
                $message = 'Saved';

            } else {
                $message = $tipoCampeonato->getErrors();
            }
        }
        $this->set([
            'data' => [
                'message' => $message,
                'tipoCampeonato' => $tipoCampeonato,
            ],
            '_serialize' => ['data']
        ]);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $tipoCampeonato = $this->TipoCampeonato->get($id);
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
    }
}
