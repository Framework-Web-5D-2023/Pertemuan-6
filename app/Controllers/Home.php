<?php

namespace App\Controllers;

class Home extends BaseController
{
  public function index(): string
  {
    // dd($this->mahasiswaModel->getAllMahasiswa());
    $mahasiswa = $this->mahasiswaModel->getAllMahasiswa();
    $data = [
      "title" => "Home",
      "nama" => "Alfian Vito",
      "biodata" => [
        [
          "name" => "Irfan",
          "npm" => "20202222"
        ],
        [
          "name" => "Toni",
          "npm" => "20213102222"
        ],
      ],
      "mahasiswa" => $mahasiswa,
    ];
    return view('home/index', $data);
  }

  public function detailMahasiswa($id)
  {
    $mahasiswa = $this->mahasiswaModel->getDetailMahasiswa($id);
    $data = [
      "title" => "Detail Mahasiswa",
      "mahasiswa" => $mahasiswa
    ];

    return view('home/detail', $data);
  }

  public function createMahasiswa()
  {
    $nama = $this->request->getVar("nama");
    $npm = $this->request->getVar("npm");
    $prodi = $this->request->getVar("prodi");
    $minat = $this->request->getVar("minat");
    $domisili = $this->request->getVar("domisili");
    $jenis_kelamin = $this->request->getVar("jenis_kelamin");

    $data = [
      "nama" => $nama,
      "npm" => $npm,
      "prodi" => $prodi,
      "minat" => $minat,
      "domisili" => $domisili,
      "jenis_kelamin" => $jenis_kelamin,
    ];

    $this->mahasiswaModel->create($data);
    $this->session->setFlashData("success", "Mahasiswa has been added");
    return redirect()->to(base_url("/"));
  }

  public function updateMahasiswa($id)
  {
    $mahasiswa = $this->mahasiswaModel->getDetailMahasiswa($id);

    $data = [
      "title" => "Update Mahasiswa",
      "mahasiswa" => $mahasiswa,
    ];

    return view("home/update", $data);
  }

  public function updateMahasiswaAction($id)
  {

    $nama = $this->request->getVar("nama");
    $npm = $this->request->getVar("npm");
    $prodi = $this->request->getVar("prodi");
    $minat = $this->request->getVar("minat");
    $domisili = $this->request->getVar("domisili");
    $jenis_kelamin = $this->request->getVar("jenis_kelamin");

    $data = [
      "nama" => $nama,
      "npm" => $npm,
      "prodi" => $prodi,
      "minat" => $minat,
      "domisili" => $domisili,
      "jenis_kelamin" => $jenis_kelamin,
    ];

    $this->mahasiswaModel->updateMahasiswa($id, $data);
    $this->session->setFlashData("success", "Mahasiswa has been updated");

    return redirect()->to(base_url("updateMahasiswa/" . $id));
  }

  public function deleteMahasiswa($id)
  {
    $this->mahasiswaModel->delete($id);
    $this->session->setFlashData("success", "Mahasiswa has been deleted");
    return redirect()->to(base_url("/"));
  }
}
