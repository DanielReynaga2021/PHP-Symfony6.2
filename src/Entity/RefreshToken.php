<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken as BaseRefreshToken;

/**
 * RefreshTokens
 *
 * @ORM\Table(name="refresh_tokens", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_9BACE7E1C74F2195", columns={"refresh_token"})})
 * @ORM\Entity
 */
class RefreshToken extends BaseRefreshToken
{


}
