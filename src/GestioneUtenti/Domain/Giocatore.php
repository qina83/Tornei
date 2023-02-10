<?php

namespace App\GestioneUtenti\Domain;

use App\Common\Domain\Eventi;
use App\Common\Domain\GestioneUtenti\DatiAnagrafici;
use App\Common\Domain\GestioneUtenti\Username;
use App\GestioneUtenti\Domain\Event\EventoGiocatoreCreato;
use App\GestioneUtenti\Domain\Event\EventoGiocatoreDisattivato;

final class Giocatore
{
    private Eventi $eventi;

    private function __construct(
        private Username $username,
        private DatiAnagrafici $datiAnagrafici,
        private StatoAttivazioneAccount $statoAttivazioneAccount
    ) {
        $this->eventi = new Eventi();
    }

    public static function nuovo(
        Username $username,
        DatiAnagrafici $datiAnagrafici
    ): self {
        $self = new self(
            $username,
            $datiAnagrafici,
            StatoAttivazioneAccount::attivo()
        );

        $self->eventi->append(
            new EventoGiocatoreCreato(
                $username,
                $datiAnagrafici
            ));

        return $self;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username->value(),
            'nome' => $this->datiAnagrafici->nome(),
            'cognome' => $this->datiAnagrafici->cognome(),
            'statoAttivazioneAccount' => $this->statoAttivazioneAccount->value(),
        ];
    }

    public function disattiva(): void
    {
        if ($this->statoAttivazioneAccount->eAttivo()) {
            $this->statoAttivazioneAccount = StatoAttivazioneAccount::disattivo();

            $this->eventi->append(
                new EventoGiocatoreDisattivato(
                    $this->username
                )
            );
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new Username($data['username']),
            new DatiAnagrafici(
                $data['nome'],
                $data['cognome']
            ),
            StatoAttivazioneAccount::fromValue($data['statoAttivazioneAccount'])
        );
    }

    public function eventi(): Eventi
    {
        return $this->eventi;
    }
}
