<?php

App::uses('AppController', 'Controller');

class OffersController extends AppController {

    public $uses = array('Offer');

    public function admin_index() {
        $offers = $this->Offer->find('all');
        $this->set(compact('offers'));
    }

    public function admin_add() {
        if ($this->request->is(array('post'))):
            $offers['Offer']['name'] = $this->request->data['Offer']['name'];
            $offers['Offer']['monthly_price'] = $this->request->data['Offer']['monthly_price'];
            $offers['Offer']['yearly_price'] = $this->request->data['Offer']['yearly_price'];
            $offers['Offer']['features'] = serialize($this->request->data['Offer']['features']);
            $this->Offer->set($offers);
            $success = $this->Offer->save();
            if ($success):
                $this->Session->setFlash(__("Offer added successfully."));
                $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
            else:
                $this->Session->setFlash(__("Offer not added successfully."));
                $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
            endif;
        endif;
    }

    public function admin_edit($offer_id = null) {
        if (!empty($offer_id)):
            $offer = $this->Offer->findById($offer_id);

            if ($this->request->is(array('post', 'put'))):
                $offers['Offer']['id'] = $offer_id;
                $offers['Offer']['name'] = $this->request->data['Offer']['name'];
                $offers['Offer']['monthly_price'] = $this->request->data['Offer']['monthly_price'];
                $offers['Offer']['yearly_price'] = $this->request->data['Offer']['yearly_price'];
                $offers['Offer']['features'] = serialize($this->request->data['Offer']['features']);
                $this->Offer->set($offers);
                $success = $this->Offer->save();
                if ($success):
                    $this->Session->setFlash(__("Offer updated successfully."));
                    $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
                else:
                    $this->Session->setFlash(__("Offer not updated successfully."));
                    $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
                endif;
            endif;

            $this->set(compact('offer'));
            $this->request->data = $offer;
        else:
            $this->Session->setFlash(__("Offer id must be entered"));
            $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
        endif;
    }

    public function admin_delete($offer_id = null) {
        if (!empty($offer_id)):
            $success = $this->Offer->delete($offer_id);
            if ($success):
                $this->Session->setFlash(__("Offer deleted successfully."));
                $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
            else:
                $this->Session->setFlash(__("Offer not deleted successfully."));
                $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
            endif;
        else:
            $this->Session->setFlash(__("Offer id must be entered"));
            $this->redirect(array('controller' => 'offers', 'action' => 'admin_index'));
        endif;
    }

}
