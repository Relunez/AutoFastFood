<?php

namespace App\Application\UseCases;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use MercadoPago\Exceptions\InvalidArgumentException;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Illuminate\Support\Str;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class MercadoPagoService
{

    private Client $httpClient;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('MERCADOPAGO_ACCESS_TOKEN','MERCADOPAGO_ACCESS_TOKEN'));
        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
        $this->httpClient = new Client();
    }

    public function createPayment(array $pedidoData): array
    {

        if (!config('MERCADOPAGO_ACCESS_TOKEN')) {
            return $this->generateStaticQrCode();
        }

        $client = new PreferenceClient();

        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = array(
            'success' => route('pedidos.atualizarStatus'),
            'failure' => route('pedidos.atualizarStatus')
        );

        $items = [];
        $valorTotal = 0;

        foreach ($pedidoData['Produtos'] as $produto) {
            $item = [
                "id" => $produto['id'],
                "title" => $produto['Nome'],
                "description" => $produto['Desc'],
                "currency_id" => "BRL",
                "quantity" => 1,
                "unit_price" => $produto['Valor']
            ];
            $valorTotal = $produto['Valor'] + $valorTotal;
            $items[] = $item;
        }

        $payer = array(
            "name" => $pedidoData['cliente']['Nome'],
            "surname" => $pedidoData['cliente']['Nome'],
            "email" => $pedidoData['cliente']['Email'],
        );

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "FastFood do seu Zé",
            "external_reference" => Str::uuid(),
            "expires" => false,
            "auto_return" => 'approved',
        ];

        try {

            $preference = $client->create($request);
            $qrData = $this->generateQrCode($preference->id, $valorTotal);

            return [
                'init_point' => $preference->init_point,
                'id' => $preference->id,
                'qr_code' => $qrData['qr_code'],
                'qr_code_base64' => $qrData['qr_code_base64'],
            ];

        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Content: ";
            var_dump($e->getApiResponse()->getContent());
            echo "\n";
        } catch (\Exception $e) {
            echo $e->getMessage();
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }

        return [];
    }

    /**
     * @throws GuzzleException
     */
    private function generateQrCode(string $preferenceId, float $valorTotal): array
    {
        $url = 'https://api.mercadopago.com/instore/orders/qr/seller/collectors/' . config('MERCADOPAGO_USER_ID') . '/pos/' . config('MERCADOPAGO_EXTERNAL_POS_ID') . '/qrs';

        $payload = [
            'external_reference' => $preferenceId,
            'title' => 'Payment QR',
            'description' => 'QR Code for order',
            'transaction_amount' => $valorTotal,
        ];

        $response = $this->httpClient->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . config('MERCADOPAGO_ACCESS_TOKEN'),
            ],
            'json' => $payload,
        ]);

        $responseData = json_decode($response->getBody()->getContents(), true);

        return [
            'qr_code' => $responseData['qr_code'],
            'qr_code_base64' => $responseData['qr_code_base64'],
        ];
    }

    private function generateStaticQrCode(): array
    {
        $Url = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley';

        $qrCode = new QrCode($Url);
        $qrCode->setSize(300);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($result->getString());

        return [
            'qr_code' => $Url,
            'qr_code_base64' => $qrCodeBase64,
        ];
    }
}
