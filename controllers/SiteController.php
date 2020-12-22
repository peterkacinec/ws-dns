<?php
namespace app\controllers;

require "../core/Controller.php";

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\services\WsService;

/**
 * Class SiteController
 */
class SiteController extends Controller
{

    protected WsService $wsService;

    public function __construct(WsService $wsService)
    {
        $this->wsService = $wsService;
    }

    public function index()
    {
        try {
            $res = $this->wsService->makeRequest('GET');
        } catch (\Exception $e) {
            Application::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->render('index', [
            'data' => $res
        ]);
    }

    public function create()
    {
        return $this->render('create');
    }

    public function store(Request $request)
    {
        $form_data = $request->getBody();
        $res = $this->wsService->makeRequest('/v1/user/' . USER_ID . '/zone/' . DOMAIN_NAME . '/record', 'POST', $form_data);

        if (isset($res['errors'])) {
            $message = $this->buildErrorMessage($res['errors']);
            Application::$app->session->setFlash('error', $message);
            Application::$app->response->redirect('/create');
        }

        if(isset($res['status']) && $res['status'] === 'success') {
            Application::$app->session->setFlash('success', 'DNS zaznam uspesne vytvoreny');
            Application::$app->response->redirect('/');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->getParamID();
        $res = $this->wsService->makeRequest( 'GET', '/'. $id);

        return $this->render('edit', [
            'data' => $res
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->getParamID();
        $form_data = $request->getBody();
        $res = $this->wsService->makeRequest('PUT', '/'. $id, $form_data);

        if (isset($res['errors'])) {
            $message = $this->buildErrorMessage($res['errors']);
            Application::$app->session->setFlash('error', $message);
            Application::$app->response->redirect('/edit');
        }

        if (isset($res['status']) && $res['status'] === 'success') {
            Application::$app->session->setFlash('success', 'DNS zaznam uspesne upraveny');
            Application::$app->response->redirect('/');
        } else {
            Application::$app->session->setFlash('error', $res['message']);
            return $this->render('edit', [
                'data' => ['id' => $id]
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->getParamID();
        $res = $this->wsService->makeRequest('DELETE', '/'. $id);

        if (isset($res['code']) && $res['code'] === 404) {
            Application::$app->session->setFlash('error', 'Record not found');
            Application::$app->response->redirect('/');
        } elseif (isset($res['status']) && $res['status'] === 'success') {
            Application::$app->session->setFlash('success', 'DNS zaznam vymazany');
            Application::$app->response->redirect('/');
        } else {
            Application::$app->session->setFlash('error', $res['message']);
            Application::$app->response->redirect('/');
        }
    }

    private function buildErrorMessage(array $errors)
    {
        $message = '';
        foreach ($errors as $i => $error) {
            foreach ($error as $key => $value) {
                $message .= '<b>'.$i . ' field</b> , ' . $value . '<br>';
            }
        }
        return $message;
    }
}