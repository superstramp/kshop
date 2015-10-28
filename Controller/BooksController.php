<?php
App::uses('AppController', 'Controller');
/**
 * Books Controller
 *
 * @property Book $Book
 * @property PaginatorComponent $Paginator
 */
class BooksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Common');
//	public $paginate = array(
//		'order' => array('Book.created' => 'desc'),
//		'limit' => 10,
//	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		echo "<meta charset ='utf-8'>";
		$this->paginate = array(
			'fields' => array('title', 'image', 'sale_price', 'slug'),
			'order' => array('Book.created' => 'desc'),
			'contain' => array(
				'Writer' => array(
					'fields' => array('name', 'slug'),
				),
			),
			'conditions' => array('Book.published' => 1),
			'limit' => 4,
			'paramType' => 'querystring',
		);
		$books = $this->paginate();
		$this->set('books', $books);
	}

	public function lastest_books() {
		echo "<meta charset ='utf-8'>";
		$this->paginate = array(
			'fields' => array('title', 'image', 'sale_price', 'slug'),
			'order' => array('Book.created' => 'desc'),
			'contain' => array(
				'Writer' => array(
					'fields' => array('name', 'slug'),
				),
			),
			'conditions' => array('Book.published' => 1),
			'limit' => 8,
			'paramType' => 'querystring'
		);
		$books = $this->paginate();
		$this->set('books', $books);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($slug = null) {
		$options = array(
			'conditions' => array('Book.slug' => $slug),
			'contain' => array(
				'Writer' => array('name', 'slug'),
			),
		);

		$book = $this->Book->find('first', $options);
		if (empty($book)) {
			throw new NotFoundException(__('Invalid book'));
		}
//		pr($book); exit();
		$this->set('book', $book);
		// Comment
		$this->loadModel('Comment');
		$c_option = array(
			'conditions' => array(
				'Comment.book_id' => $book['Book']['id'],
			),
			'order' => array('Comment.created' => 'asc'),
			'contain' => array(
				'User' => array(
					'fields' => array('fullname'),
				),
			)
		);
		$comments = $this->Comment->find('all', $c_option);
		$this->set('comments', $comments);

		//hiển thị sách liên quan
		$related_books = $this->Book->find('all', array(
			'fields' => array('title', 'image', 'sale_price', 'slug'),
			'conditions' => array(
				'category_id' => $book['Book']['category_id'],
				'Book.id <>' => $book['Book']['id'],
				'published' => 1
			),
			'limit' => 4,
			'order' => 'rand()',
			'contain' => array(
				'Writer' => array('name', 'slug')
			)
		));
		//pr($related_books);
		$this->set('related_books', $related_books);
		//validation comment
		if($this->Session->check('comment_errors')) {
			$comment_errors = $this->Session->read('comment_errors');
			$this->set('comment_errors', $comment_errors);
			$this->Session->delete('comment_errors');
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Book->create();
			if ($this->Book->save($this->request->data)) {
				$this->Session->setFlash(__('The book has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Book->Category->find('list');
		$writers = $this->Book->Writer->find('list');
		$this->set(compact('categories', 'writers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Book->exists($id)) {
			throw new NotFoundException(__('Invalid book'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Book->save($this->request->data)) {
				$this->Session->setFlash(__('The book has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Book.' . $this->Book->primaryKey => $id));
			$this->request->data = $this->Book->find('first', $options);
		}
		$categories = $this->Book->Category->find('list');
		$writers = $this->Book->Writer->find('list');
		$this->set(compact('categories', 'writers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Book->id = $id;
		if (!$this->Book->exists()) {
			throw new NotFoundException(__('Invalid book'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Book->delete()) {
			$this->Session->setFlash(__('The book has been deleted.'));
		} else {
			$this->Session->setFlash(__('The book could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function get_keyword() {
		if($this->request->is('post')) {
			$this->Book->set($this->request->data);
			if($this->Book->validates()) {
				$keyword = $this->request->data['Book']['keyword'];
			} else {
				$validate_errors = $this->Book->validationErrors;
				$this->Session->write('keyword_validate_error', $validate_errors);
			}
			$this->redirect(array('action' => 'search', 'keyword' => $keyword));
		}
	}

	public function search($keyword = null) {
		$notfound = false;
		if(!empty($this->request->params['named']['keyword'])) {
			$keyword = $this->request->params['named']['keyword'];
			$this->paginate = array(
				'fields' => array('id', 'title', 'image', 'sale_price', 'slug'),
				'order' => 'rand()',
				'limit' => 2,
				'contain' => array(
					'Writer' => array(
						'fields' => array('name', 'slug'),
					),
				),
				'joins' => array(
					array(
						'table' => 'books_writers',
						'alias' => 'BookWriter',
						'conditions' => 'BookWriter.book_id = Book.id',
					),
					array(
						'table' => 'writers',
						'alias' => 'Writer',
						'conditions' => 'Writer.id = BookWriter.writer_id',
					),
				),
				'conditions' => array(
					'Book.published' => 1,
					'or' => array(
						'Book.title like' => '%' . $keyword . '%',
						'Writer.name like' => '%' . $keyword . '%',
					),
				),
				'paramType' => 'querystring',
			);

			$books = $this->paginate('Book');
			if (empty($books)) {
				$notfound = true;
			} else {
				$this->set('books', $books);
			}

			$this->set('keyword', $keyword);
		}

		if($this->Session->check('keyword_validate_error')) {
			$keyword_validate_error = $this->Session->read('keyword_validate_error');
			$this->set('error_keyword', $keyword_validate_error);
			$this->Session->delete('keyword_validate_error');
		}

		$this->set('notfound', $notfound);
	}

	public function add_to_cart($id = null) {
		if($this->request->is('post')) {
			$book = $this->Book->find('first', array(
				'recursive' => -1,
				'conditions' => array(
					'Book.id' => $id,
				)
			));
			if ($this->Session->check('cart.' . $book['Book']['id'])) {
				$item = $this->Session->read('cart.' . $book['Book']['id']);
				$item['quantity'] += 1;
			} else {
				$item = array(
					'id' => $book['Book']['id'],
					'title' => $book['Book']['title'],
					'slug' => $book['Book']['slug'],
					'sale_price' => $book['Book']['sale_price'],
					'quantity' => 1,
				);
			}

			$this->Session->write('cart.' . $id, $item);

			$cart = $this->Session->read('cart');
			$total = $this->Common->sum_cart_price($cart);
			$this->Session->write('payment.total', $total);
			$this->Session->setFlash('Đã thêm quyển sách vào trong giỏ hàng!', 'default', array('class' => 'alert alert-info'), 'cart');
			$this->redirect($this->referer());
		}
	}

	public function view_cart() {
		$this->layout = 'cart_layout';
		$cart = $this->Session->read('cart');
		$payment = $this->Session->read('payment');
		$this->set('cart', $cart);
		$this->set('payment', $payment);

	}

	public function empty_cart() {
		if($this->request->is('post')) {
			$this->Session->delete('cart');
			$this->Session->delete('payment');
			$this->redirect($this->referer());
		}
	}

	public function remove($id = null) {
		if($this->request->is('post')) {
			$this->Session->delete('cart.'.$id);
			$cart = $this->Session->read('cart');
			if(empty($cart)) {
				$this->empty_cart();
			} else {
				$total = $this->Common->sum_cart_price($cart);
				$this->Session->write('payment.total', $total);
			}
			$this->redirect($this->referer());
		}
	}

//	public function update_comment_count(){
//		$books = $this->Book->find('all', array(
//			'fields' => 'id',
//			'contain' => 'Comment',
//		));
//
//		foreach($books as $book) {
//			if(count($book['Comment']) > 0) {
//				$this->Book->updateAll(
//					array('Book.comment_count' => count($book['Comment'])),
//					array('Book.id' => $book['Book']['id'])
//				);
//			}
//		}
//	}
}
