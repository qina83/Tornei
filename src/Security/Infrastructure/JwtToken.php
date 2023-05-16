<?php

namespace App\Security\Infrastructure;

use App\Security\Domain\AuthToken;
use App\Security\Domain\Utente;
use DateTimeImmutable;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\JwtFacade;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;

class JwtToken implements  AuthToken
{
    public function fromUtente(Utente $utente): string
    {
        $key = InMemory::base64Encoded(
            'hiG8DlOKvtih6AxlZn5XKImZ06yu8I3mkOzaJrEuW8yAv8Jnkw330uMt8AEqQ5LB'
        );

        $token = (new JwtFacade())->issue(
            new Sha256(),
            $key,
            static fn(
                Builder $builder,
                DateTimeImmutable $issuedAt
            ): Builder => $builder
                ->issuedBy('gestione_tornei')
                ->permittedFor('gestione_tornei')
                ->expiresAt($issuedAt->modify('+10 minutes'))
                ->identifiedBy($utente->getUserIdentifier())
        );
        return $token->toString();
    }

}
