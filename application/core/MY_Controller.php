<?
class MY_Controller extends CI_Controller {
    protected $the_user;
    protected $logged_in;

    public function __construct() {

        parent::__construct();
        $data->logged_in=false;
        $this->logged_in=false;
        if($this->ion_auth->logged_in()) {
            $data->logged_in=true;
            $this->logged_in=$data->logged_in;
            $data->the_user = $this->ion_auth->user()->row();
            $this->the_user = $data->the_user;
        }
        $this->load->vars($data);

    }
}
?>