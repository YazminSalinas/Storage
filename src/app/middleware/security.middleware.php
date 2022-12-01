<?php
class SecurityMiddleware extends BaseMiddleware {
    public function verifyApiKey( $pToken ) {
        $apiKey = $this->getConfig('credenciales')['abaco'];
        $apiKeyRequest = $this->getHeaders('Api-Key');
        $verb = $this->getVerb();
        
        if( $verb === 'GET' && is_null($apiKeyRequest ) ) {
            $apiKeyRequest = $this->getQuery('Api-Key');
        }

        if( is_null( $apiKeyRequest ) || $apiKey !== $apiKeyRequest ) {
            throw new ErrorsAuth('Credenciales incorrectas');
        }
    }
}