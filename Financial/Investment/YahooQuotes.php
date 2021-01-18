<?php

/**
 * Responsible managing the channel of Yahoo quotes
 * @requires DateTime
 * @requires AbstractWebRequest
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class YahooQuotes extends AbstractWebRequest {

    /**
     * @var string A text with the URL with end-point address
     */
    private $END_POINT;

    /**
     * mount a end-point with data to find quotes
     * @return void
     */
    public function Refresh_END_POINT(): void {
        $Ticker = $this->getTicker();
        $StartDate = $this->getStartDate()->getTimestamp();
        $EndDate = $this->getEndDate()->getTimestamp();
        $this->END_POINT = "https://finance.yahoo.com/quote/$Ticker.SA/history?period1=$StartDate&period2=$EndDate&interval=1d&filter=history&frequency=1d";
    }

    /**
     * @var resource A resource with the cURL channel
     */
    private $Channel;

    /**
     * @var DateTime An instance of DateTime to represents the start date
     */
    private $startDate;

    /**
     * @return \DateTime An instance of DateTime to represents the start date
     */
    public function getStartDate(): DateTime {
        return $this->startDate;
    }

    /**
     * @param string $startDate A text with the formated start date
     * @return void
     */
    public function setStartDate(string $startDate): void {
        $startDate = str_repeat("/", "-", $startDate);
        $timestamp = strtotime($startDate);
        $this->startDate->setTimestamp($timestamp);
    }

    /**
     * @var DateTime An instance of DateTime to represents the end date
     */
    private $endDate;

    /**
     * @return \DateTime An instance of DateTime to represents the end date
     */
    public function getEndDate(): DateTime {
        return $this->endDate;
    }

    /**
     * @param string $endDate A text with the formated end date
     */
    public function setEndDate(string $endDate): void {
        $endDate = str_repeat("/", "-", $endDate);
        $timestamp = strtotime($endDate);
        $this->endDate->setTimestamp($timestamp);
    }

    /**
     * @var string A text with the code of the asset to find quotes
     */
    private $ticker;

    /**
     * @return string A text with the code of the asset to find quotes
     */
    public function getTicker(): string {
        return $this->ticker;
    }

    /**
     * @param string $ticker A text with the code of the asset to find quotes
     */
    public function setTicker(string $ticker): void {
        $this->ticker = strtoupper(trim($ticker));
    }

    /**
     * @var array An array with collection of data quotes
     */
    private $Result;

    /**
     * Initialize an instance of YahooQuotes
     */
    public function __construct() {
        parent::__construct();
        $this->startDate = new DateTime();
        $this->endDate = new DateTime();
    }

    protected function DoGet() {
        switch ($this->Token) {
            default:
                $this->InvadRequest();
                break;
        }
    }

    protected function DoPost() {
        switch ($this->Token) {
            case "E7254AD7-DE861254-A90D17BA-B271795B":
                $this->GetQuotesToday();
                break;

            case "23D81883-EAD13E96-5B2A3274-81D4F1C3":
                $this->GetQuotesMonthly();
                break;

            case "C1C57F15-96C5A3CB-B8770E8A-8157EEF7":
                $this->Yearly();
                break;

            default:
                $this->InvadRequest();
                break;
        }
    }

    /**
     * Define options to execution in the channel
     */
    private function AutoSetupOptions() {
        // Define return type to response, true return response, if false it print the response
        curl_setopt($this->Channel, CURLOPT_RETURNTRANSFER, true);
        // Set end-point to channel
        curl_setopt($this->Channel, CURLOPT_URL, $this->END_POINT);
    }

    private function OpenChannelCURL() {
        // Reset end-point to request
        $this->Refresh_END_POINT();

        //Initialize the resource cURL channel
        $this->Channel = curl_init();

        if (is_resource($this->Channel)) {
            // Set default option to CURL
            $this->AutoSetupOptions();
            // Define status
            $this->Status->setCode("CONN");
            return true;
        } else {
            // Define status
            $this->Status->setCode("NCONN");
            return true;
        }
    }

    public function ExecuteRequest() {
        if ($this->OpenChannelCURL()) {
            // Set success result
            $this->Result = curl_exec($this->Channel);
        } else {
            // Set bad result
            $this->Result = false;
            // Define status
            $this->Status->setCode("SR");
            $this->Status->Message->setContent(curl_error($this->Channel));
        }
    }

    public function CloseChannelCURL() {
        if (is_resource($this->Channel)) {
            // close channel
            curl_close($this->Channel);
        }
    }

    /**
     * Execute a request to obtains quotes of asset in the date interval
     */
    private function GetQuotes() {
        // Execute the prepared request
        $this->ExecuteRequest();

        if ($this->Result) {
            // Traitment of the result
            $this->Result = explode("root.App.main = ", $this->Result)[1];

            if ($this->Result) {
                // Traitment of the result
                $this->Result = explode(";\n}(this));", $this->Result)[0];

                if ($this->Result) {
                    // Traitment of the result
                    $this->Result = json_decode($this->Result, true);

                    if ($this->Result) {
                        // Data collection of quites
                        $CopyResult = $this->Result;
                        $this->Result = null;
                        $this->Result["Prices"] = $CopyResult["context"]["dispatcher"]["stores"]["HistoricalPriceStore"]["prices"];
                        $this->Result["Dividends"] = $CopyResult["context"]["dispatcher"]["stores"]["HistoricalPriceStore"]["eventsData"];

                        // Define status
                        $this->Status->setCode("OK");
                    } else {
                        // Define status
                        $this->Status->setCode("SR");
                        $this->Status->Message->setContent(curl_error($this->Channel));
                    }
                } else {
                    // Define status
                    $this->Status->setCode("SR");
                    $this->Status->Message->setContent(curl_error($this->Channel));
                }
            } else {
                // Define status
                $this->Status->setCode("SR");
                $this->Status->Message->setContent(curl_error($this->Channel));
            }
        } else {
            // Define status
            $this->Status->setCode("SR");
            $this->Status->Message->setContent(curl_error($this->Channel));
        }

        // Close the channel
        $this->CloseChannelCURL();

        // send response
        $this->ResponseJSON($this->Result, $this->Status);
    }

    private function GetQuotesToday() {
        // Define the timezone from brazil
        date_default_timezone_set("America/Sao_Paulo");
        // Get the system date
        $Today = new DateTime();
        // Prepare and execute
        $this->setTicker($_POST["Ticker"]);
        $this->setStartDate($Today->format("Y-m-d"));
        $this->setEndDate($Today->format("Y-m-d"));
        $this->GetQuotes();
    }

}

/**
 * Direct access
 */
$QuotesCT = new YahooQuotes();
$QuotesCT->ValidateRequest();
