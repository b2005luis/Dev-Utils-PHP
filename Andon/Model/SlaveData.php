<?php

/**
 * Represets an instance of SlaveData
 * @requires DateTime
 * @requires Server
 * @requires SlaveDevice
 * @requires SlaveState
 * @requires Shift
 * @author Luis Alberto Batista Pedroso
 */
class SlaveData
{
    /**
     * @var int A number with the identifier to SlaveData
     */
    private $id;

    /**
     * @var Server A instance of Server
     */
    public $AndonServer;

    /**
     * @var SlaveDevice A instance of SlaveDevice
     */
    public $Device;

    /**
     * @var DateTime A number with the identifier to SlaveData
     */
    private $StartDate;

    /**
     * @var DateTime An instance with DateTime to end date
     */
    private $EndDate;

    /**
     * @var Shift Uma instancia de Horario.
     */
    public $Shift;

    /**
     * @var int A number with quantity duration of envent
     */
    private $duration;

    /**
     * @var SlaveState An Instance of SlaveState
     */
    public $State;

    /**
     * @var int A number with the ID of current state on this channel
     */
    private $channel1;

    /**
     * @var int A number with the ID of current state on this channel
     */
    private $channel2;

    /**
     * @var int A number with the ID of current state on this channel
     */
    private $channel3;

    /**
     * @var int A number with the ID of current state on this channel
     */
    private $channel4;

    /**
     * @var int A number with the ID of error current state on this channel
     */
    private $error;

    /**
     * @return int A number with the identifier to SlaveData
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier to SlaveData
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $date An instance with DateTime to start date
     * @return void
     */
    public function setStartDate(string $date): void
    {
        $date = str_repeat("/", "-", $date);
        $this->StartDate->setTimestamp(strtotime($$date));
    }

    /**
     * @param string $date An instance with DateTime to end date
     * @return void
     */
    public function setEndDate(string $date): void
    {
        $date = str_replace("/", "-", $date);
        $this->EndDate->setTimestamp(strtotime($date));
    }

    /**
     * @return int A number with quantity duration of envent
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration A number with quantity duration of envent
     * @return void
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return int A number with the ID of current state on this channel
     */
    public function getChannel1(): int
    {
        return $this->channel1;
    }

    /**
     * @param int $channel1 Um numero inteiro com o status definido neste canal.
     * @return void
     */
    public function setChannel1(int $channel1): void
    {
        $this->channel1 = $channel1;
    }

    /**
     * @return int A number with the ID of current state on this channel
     */
    public function getChannel2(): int
    {
        return $this->channel2;
    }

    /**
     * @param int $channel2 A number with the ID of current state on this channel
     * @return void
     */
    public function setChannel2(int $channel2): void
    {
        $this->channel2 = $channel2;
    }

    /**
     * @return int A number with the ID of current state on this channel
     */
    public function getChannel3(): int
    {
        return $this->channel3;
    }

    /**
     * @param int $channel3 A number with the ID of current state on this channel
     * @return void
     */
    public function setChannel3(int $channel3): void
    {
        $this->channel3 = $channel3;
    }

    /**
     * @return int A number with the ID of current state on this channel
     */
    public function getChannel4(): int
    {
        return $this->channel4;
    }

    /**
     * @param int $channel4 A number with the ID of current state on this channel
     */
    public function setChannel4(int $channel4): void
    {
        $this->channel4 = $channel4;
    }

    /**
     * @return int A number with the ID of error current state on this channel
     */
    public function getError(): int
    {
        return $this->error;
    }

    /**
     * @param int $error A number with the ID of error current state on this channel
     * @return void
     */
    public function setError(int $error): void
    {
        $this->error = $error;
    }

    /**
     * @return SlaveData An instance of SlaveData
     */
    public function __construct()
    {
        $this->AndonServer = new Server();
        $this->Device = new SlaveDevice();
        $this->State = new SlaveState();
        $this->Shift = new Shift();
        $this->StartDate = new DateTime();
        $this->EndDate = new DateTime();
    }

    /**
     * Check and define the cuted time for start date
     * @param DateTime $Date An instance of DateTime with a default date
     * @return void
     */
    public function CutStartDate(DateTime $Date): void
    {
        if ($this->StartDate->getTimestamp() < $Date->getTimestamp()) {
            $this->StartDate->setTimestamp($Date->getTimestamp());
        }
    }

    /**
     * Check and define the cuted time for end date
     * @param DateTime $Date An instance of DateTime with a default date
     * @return void
     */
    public function CutEndDate(DateTime $Date): void
    {
        if ($this->EndDate->getTimestamp() > $Date->getTimestamp()) {
            $this->EndDate->setTimestamp($Date->getTimestamp());
        }
    }

    /**
     * Update duration time based in date difference between end and start date
     * @return void
     */
    public function UpdateDuration(): void
    {
        $newDuration = $this->EndDate->getTimestamp() - $this->StartDate->getTimestamp();
        $this->setDuration($newDuration);
    }

    /**
     * Check and define the current activated channel and you state id
     * @return void
     */
    public function DefineCurrentState(): void
    {
        if ($this->getError() == 0) {
            $activated = 0;

            if ($this->getChannel1() > 0) {
                $this->State->setId($this->getChannel1());
                $activated++;
            }
            if ($this->getChannel2() > 0) {
                $this->State->setId($this->getChannel2());
                $activated++;
            }
            if ($this->getChannel3() > 0) {
                $this->State->setId($this->getChannel3());
                $activated++;
            }
            if ($this->getChannel3() > 0) {
                $this->State->setId($this->getChannel3());
                $activated++;
            }
            if ($activated == 0 || $activated > 1) {
                $this->State->setId(7);
            }
        } else {
            $this->State->setId(6);
        }
    }

    /**
     * Return a array with the data of instance SlaveData
     * @return array A array with the data of instance SlaceData
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "AndonServer" => $this->AndonServer->GetInstanceArray(),
            "Device" => $this->Device->GetInstanceArray(),
            "State" => $this->State->GetInstanceArray(),
            "Shift" => $this->Shift->GetInstanceArray(),
            "startDate" => $this->StartDate->format("Y-m-d H:i:s"),
            "endDate" => $this->EndDate->format("Y-m-d H:i:s"),
            "duration" => $this->getDuration(),
            "channel1" => $this->getChannel1(),
            "channel2" => $this->getChannel2(),
            "channel3" => $this->getChannel3(),
            "channel4" => $this->getChannel4(),
            "error" => $this->getError()
        ];
    }
}