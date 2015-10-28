<?php
class Example extends Object
{
//======================================================================================================================
    /**
     * @date     : Tuesday, September 15th 2015
     * @author   : Dungna - Damien Rice
     * @purpose  : Cakephp - Database Access - MySql (or ...)
     * @io       : The blower's daughter
     * @UnitNo   : One
     */
//======================================================================================================================
// Note: find() and query()
// find()  : all, first, list, count, neighbors, threaded.
// query() : query
// option  : fields, conditions, order, limit, recursive (-1 to 2, default 0)
// example : -- No hero in her sky
    public function example_sql()
    {
        echo "<meta charset='utf-8'";
        $results = $this->Book->find('all', array(
            'fields' => array('id', 'title'),
            'recursive' => -1,
            'conditions' => array('id <' => 11),
            'order' => array('title' => 'asc'),
            'limit' => 5
        ));
        // $query = 'SELECT * FROM books';
        // $results = $this->Book->query($query);
        pr($results);
        exit;
    }
//======================================================================================================================
// Note : Containable Behavior
// 1. Initialize on Model want to use:
    public function example_containable()
    {
        $actsAs = array('Containable'); // On model Book
        $results = $this->Book->find('all', array(
            'fields' => array('id', 'title'),
            //'contain' => 'Writer', // Relationship model that you want to get data
            'contain' => array('Writer', 'Comment' => array(
                'fields' => array('id', 'comment'),
            )),
            'conditions' => array('id <' => 11),
            'order' => array('title' => 'asc'),
            'limit' => 5
        ));
    }
//  Note : Just access database table have relation with current model
//======================================================================================================================
// Note: Pagination in cakephp
    public function lastest_books() {
        echo "<meta charset ='utf-8'>";
        $this->paginate = array(
            'fields' => array('title', 'image', 'sale_price', 'slug'),
            'order' => array('Book.created' => 'desc'),
            'contain' => array(
                'Writer' => array(
                    'fields' => array('name'),
                ),
            ),
            'conditions' => array('Book.published' => 1),
            'limit' => 5,
            'paramType' => 'querystring'
        );
        $books = $this->paginate();
        $this->set('books', $books);

        //<p>
        //<?php echo $this->Paginator->counter("Page {:page} of {:pages}, show {:current} books in {:count} books"); <!-- <br>-->
         //echo $this->Paginator->prev('Previous'); 
         //echo $this->Paginator->numbers(array('separator' => ' - ')) 
         //echo $this->Paginator->next('Next'); 
         //echo $this->Paginator->sort('title', 'Sort by book title');
         //echo $this->Paginator->sort('created', 'Sort by date'); 
    }
//======================================================================================================================
// Note: element in cakephp
//echo $this->element('pagination', array('object' => "books"));

//======================================================================================================================
// Note add comment and validate data form model
// Inside model
    public $validate = array(
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'book_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'content' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Message is not empty',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'minlength' => array(
                'rule' => array('minLength',8),
                'message' => 'Minlength: 8'
            )
        ),
    );
// Inside Controller
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Comment->set($this->request->data);
            if ($this->Comment->validates()) {
                $this->Comment->create();
                if ($this->Comment->save($this->request->data)) {
                    $this->Session->setFlash(__('The comment has been saved.'));
                } else {
                    $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                }
            } else {
                $comment_errors = $this->Comment->validationErrors;
                $this->Session->write('comment_errors', $comment_errors);
            }

        }
        $this->redirect($this->referer());
//		$users = $this->Comment->User->find('list');
//		$books = $this->Comment->Book->find('list');
//		$this->set(compact('users', 'books'));
    }
// Inside view
    public function validationData(){
//        <div class="comments form">
//        <?php if(isset($comment_errors)) { ?>
<!--            --><?php //foreach($comment_errors as $comment_error) { ?>
<!--                --><?php //echo "Error: ".$comment_error[0]; ?>
<!--            --><?php //} ?>
<!--        --><?php //} ?>

        <?php echo $this->Form->create('Comment', array('action' => 'add', 'novalidate' => true)); ?>
        <fieldset>
            <legend>Add Comment</legend>
            <?php
            echo $this->Form->input('user_id', array('required' => false, 'label' => '', 'type' => 'text', 'value' => 1, 'hidden' => true));
            echo $this->Form->input('book_id', array('required' => false, 'label' => '', 'type' => 'text', 'value' => 1, 'hidden' => true));
            echo $this->Form->input('content');
            ?>
        </fieldset>
        <?php echo $this->Form->end(" Submit "); ?>
        </div>
    }
//======================================================================================================================
// Note: CounterCache
//Inside Model with relation belongto
//counterCache => true;
//Inside Db, table: add new row is modelname_count => auto update when update db

// post link
//echo $this->Form->postLink('Lam rong gio hang', '/books/empty_cart', array('class' => 'col-lg-3 btn btn-default empty'));

}