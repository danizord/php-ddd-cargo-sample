<?php
/*
 * This file is part of the prooph/php-ddd-cargo-sample package.
 * (c) Alexander Miertsch <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CargoBackendTest\Domain\Model\Cargo;

use CargoBackend\Model\Cargo\Itinerary;
use CargoBackendTest\Fixture\LegFixture;
use CargoBackendTest\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use CargoBackend\Model\Cargo\Leg;
/**
 * Class ItineraryTest
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ItineraryTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_list_of_legs()
    {
        $legs = [LegFixture::get(LegFixture::HONGKONG_NEWYORK), LegFixture::get(LegFixture::NEWYORK_HAMBURG)];

        $itinerary = new Itinerary($legs);
        
        $this->assertSame($legs, $itinerary->legs());
    }

    /**
     * @test
     */
    public function it_is_same_value_as_itinerary_with_same_legs()
    {
        $legs = [LegFixture::get(LegFixture::HONGKONG_NEWYORK), LegFixture::get(LegFixture::NEWYORK_HAMBURG)];

        $itinerary = new Itinerary($legs);
        $sameItinerary = new Itinerary($legs);
        
        $this->assertTrue($itinerary->sameValueAs($sameItinerary));
    }

    /**
     * @test
     */
    public function it_is_not_same_value_as_itinerary_with_other_list_of_legs()
    {
        $legs = [LegFixture::get(LegFixture::HONGKONG_NEWYORK), LegFixture::get(LegFixture::NEWYORK_HAMBURG)];

        $itinerary = new Itinerary($legs);

        $otherLegs = [LegFixture::get(LegFixture::HONGKONG_HAMBURG), LegFixture::get(LegFixture::HAMBURG_ROTTERDAM)];

        $otherItinerary = new Itinerary($otherLegs);

        $this->assertFalse($itinerary->sameValueAs($otherItinerary));
    }
}
