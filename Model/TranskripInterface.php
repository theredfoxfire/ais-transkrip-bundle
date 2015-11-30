<?php

namespace Ais\TranskripBundle\Model;

Interface TranskripInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set nim
     *
     * @param string $nim
     *
     * @return Transkrip
     */
    public function setNim($nim);

    /**
     * Get nim
     *
     * @return string
     */
    public function getNim();

    /**
     * Set nama
     *
     * @param string $nama
     *
     * @return Transkrip
     */
    public function setNama($nama);

    /**
     * Get nama
     *
     * @return string
     */
    public function getNama();

    /**
     * Set noSeri
     *
     * @param string $noSeri
     *
     * @return Transkrip
     */
    public function setNoSeri($noSeri);

    /**
     * Get noSeri
     *
     * @return string
     */
    public function getNoSeri();

    /**
     * Set tanggalLulus
     *
     * @param \DateTime $tanggalLulus
     *
     * @return Transkrip
     */
    public function setTanggalLulus($tanggalLulus);

    /**
     * Get tanggalLulus
     *
     * @return \DateTime
     */
    public function getTanggalLulus();

    /**
     * Set tanggalCetak
     *
     * @param \DateTime $tanggalCetak
     *
     * @return Transkrip
     */
    public function setTanggalCetak($tanggalCetak);

    /**
     * Get tanggalCetak
     *
     * @return \DateTime
     */
    public function getTanggalCetak();

    /**
     * Set judulSkripsi
     *
     * @param string $judulSkripsi
     *
     * @return Transkrip
     */
    public function setJudulSkripsi($judulSkripsi);

    /**
     * Get judulSkripsi
     *
     * @return string
     */
    public function getJudulSkripsi();

    /**
     * Set keterangan
     *
     * @param string $keterangan
     *
     * @return Transkrip
     */
    public function setKeterangan($keterangan);

    /**
     * Get keterangan
     *
     * @return string
     */
    public function getKeterangan();

    /**
     * Set noIjasah
     *
     * @param string $noIjasah
     *
     * @return Transkrip
     */
    public function setNoIjasah($noIjasah);

    /**
     * Get noIjasah
     *
     * @return string
     */
    public function getNoIjasah();

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Transkrip
     */
    public function setUserId($userId);

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return Transkrip
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
