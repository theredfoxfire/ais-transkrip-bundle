<?php

namespace Ais\TranskripBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ais\TranskripBundle\Model\TranskripInterface;

/**
 * Transkrip
 */
class Transkrip implements TranskripInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nim;

    /**
     * @var string
     */
    private $nama;

    /**
     * @var string
     */
    private $no_seri;

    /**
     * @var \DateTime
     */
    private $tanggal_lulus;

    /**
     * @var \DateTime
     */
    private $tanggal_cetak;

    /**
     * @var string
     */
    private $judul_skripsi;

    /**
     * @var string
     */
    private $keterangan;

    /**
     * @var string
     */
    private $no_ijasah;

    /**
     * @var integer
     */
    private $user_id;

    /**
     * @var boolean
     */
    private $is_delete;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nim
     *
     * @param string $nim
     *
     * @return Transkrip
     */
    public function setNim($nim)
    {
        $this->nim = $nim;

        return $this;
    }

    /**
     * Get nim
     *
     * @return string
     */
    public function getNim()
    {
        return $this->nim;
    }

    /**
     * Set nama
     *
     * @param string $nama
     *
     * @return Transkrip
     */
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get nama
     *
     * @return string
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set noSeri
     *
     * @param string $noSeri
     *
     * @return Transkrip
     */
    public function setNoSeri($noSeri)
    {
        $this->no_seri = $noSeri;

        return $this;
    }

    /**
     * Get noSeri
     *
     * @return string
     */
    public function getNoSeri()
    {
        return $this->no_seri;
    }

    /**
     * Set tanggalLulus
     *
     * @param \DateTime $tanggalLulus
     *
     * @return Transkrip
     */
    public function setTanggalLulus($tanggalLulus)
    {
        $this->tanggal_lulus = $tanggalLulus;

        return $this;
    }

    /**
     * Get tanggalLulus
     *
     * @return \DateTime
     */
    public function getTanggalLulus()
    {
        return $this->tanggal_lulus;
    }

    /**
     * Set tanggalCetak
     *
     * @param \DateTime $tanggalCetak
     *
     * @return Transkrip
     */
    public function setTanggalCetak($tanggalCetak)
    {
        $this->tanggal_cetak = $tanggalCetak;

        return $this;
    }

    /**
     * Get tanggalCetak
     *
     * @return \DateTime
     */
    public function getTanggalCetak()
    {
        return $this->tanggal_cetak;
    }

    /**
     * Set judulSkripsi
     *
     * @param string $judulSkripsi
     *
     * @return Transkrip
     */
    public function setJudulSkripsi($judulSkripsi)
    {
        $this->judul_skripsi = $judulSkripsi;

        return $this;
    }

    /**
     * Get judulSkripsi
     *
     * @return string
     */
    public function getJudulSkripsi()
    {
        return $this->judul_skripsi;
    }

    /**
     * Set keterangan
     *
     * @param string $keterangan
     *
     * @return Transkrip
     */
    public function setKeterangan($keterangan)
    {
        $this->keterangan = $keterangan;

        return $this;
    }

    /**
     * Get keterangan
     *
     * @return string
     */
    public function getKeterangan()
    {
        return $this->keterangan;
    }

    /**
     * Set noIjasah
     *
     * @param string $noIjasah
     *
     * @return Transkrip
     */
    public function setNoIjasah($noIjasah)
    {
        $this->no_ijasah = $noIjasah;

        return $this;
    }

    /**
     * Get noIjasah
     *
     * @return string
     */
    public function getNoIjasah()
    {
        return $this->no_ijasah;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Transkrip
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Transkrip
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
}
