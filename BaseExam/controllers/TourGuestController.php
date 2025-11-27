<?php
require_once PATH_MODEL . "Tour.php";
require_once PATH_MODEL . "TourGuest.php";

class TourGuestController
{
    private $tour;
    private $guest;

    public function __construct()
    {
        $this->tour  = new Tour();
        $this->guest = new TourGuest(); // KHÔNG ĐƯỢC BÁO ĐỎ NỮA
    }

    public function index()
    {
        $tour_id = $_GET['tour_id'];
        $tour = $this->tour->find($tour_id);
        $guests = $this->guest->getByTour($tour_id);

        require PATH_VIEW . "tour_guest/index.php";
    }

    public function store()
    {
        $id = $this->guest->add($_POST);
        $tour = $this->tour->find($_POST['tour_id']);

        require PATH_VIEW . "tour_guest/success.php";
    }

    public function detail()
    {
        $id = $_GET['id'];
        $guest = $this->guest->find($id);
        $tour  = $this->tour->find($guest['tour_id']);

        require PATH_VIEW . "tour_guest/detail.php";
    }

    public function updateCheckin()
    {
        $id = $_POST['id'];
        $status = $_POST['trang_thai'];

        $this->guest->updateCheckin($id, $status);

        header("Location: ?action=tour_guest&tour_id=" . $_GET['tour_id']);
    }

    public function updateRoom()
    {
        $id = $_POST['id'];
        $room = $_POST['phong'];

        $this->guest->updateRoom($id, $room);

        header("Location: ?action=tour_guest&tour_id=" . $_GET['tour_id']);
    }

    public function export()
    {
        $tour_id = $_GET['tour_id'];
        $tour = $this->tour->find($tour_id);
        $guests = $this->guest->export($tour_id);

        require PATH_VIEW . "tour_guest/export.php";
    }
}
