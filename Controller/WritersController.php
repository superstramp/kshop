<?php
App::uses('AppController', 'Controller');
/**
 * Writers Controller
 *
 * @property Writer $Writer
 * @property PaginatorComponent $Paginator
 */
class WritersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Writer->recursive = 0;
		$this->set('writers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($slug = null) {
		$woptions = array(
			'recursive' => -1,
			'conditions' => array('Writer.slug' => $slug),
		);
		$writers = $this->Writer->find('first', $woptions);

		if (empty($writers)) {
			throw new NotFoundException(__('Invalid writer'));
		}
		$this->set('writer', $writers);

		//relationship book
		$this->paginate = array(
			'fields' => array('title', 'image', 'id', 'sale_price', 'slug'),
			'order' => array('Book.created' => 'desc'),
			'limit'=>3,
			'contain' => array(
				'Writer' => array('name', 'slug'),
			),
			'joins' => array(
				array(
					'table' => 'books_writers',
					'alias' => 'BookWriter',
					'conditions' => 'BookWriter.book_id = Book.id'
				),
				array(
					'table' => 'writers',
					'alias' => 'Writer',
					'conditions' => 'BookWriter.writer_id = Writer.id'
				),
			),
			'conditions' => array(
				'Book.published' => 1,
				'Writer.slug' => $slug,
			),
			'paramType' => 'querystring',
		);
		$books = $this->paginate('Book');
		$this->set('books', $books);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Writer->create();
			if ($this->Writer->save($this->request->data)) {
				$this->Session->setFlash(__('The writer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The writer could not be saved. Please, try again.'));
			}
		}
		$books = $this->Writer->Book->find('list');
		$this->set(compact('books'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Writer->exists($id)) {
			throw new NotFoundException(__('Invalid writer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Writer->save($this->request->data)) {
				$this->Session->setFlash(__('The writer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The writer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Writer.' . $this->Writer->primaryKey => $id));
			$this->request->data = $this->Writer->find('first', $options);
		}
		$books = $this->Writer->Book->find('list');
		$this->set(compact('books'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Writer->id = $id;
		if (!$this->Writer->exists()) {
			throw new NotFoundException(__('Invalid writer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Writer->delete()) {
			$this->Session->setFlash(__('The writer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The writer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
