<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // User
        $User = new User();
        $User->setemail('User@user.com');
        $User->setroles(['ROLE_USER']);
        $User->setpassword('$argon2id$v=19$m=65536,t=4,p=1$UGhNd3JLMXlKb2lmNEN4Rg$bLtoypKxj+EctISMvI/pvU8E48rJn+t3GxqKyEs/g7k');
        $manager->persist($User);

        // Admin
        $User = new User();
        $User->setemail('Admin@admin.com');
        $User->setroles(['ROLE_ADMIN']);
        $User->setpassword('$argon2id$v=19$m=65536,t=4,p=1$T1pJdlFkSndsVFJHc2NTMw$aBTfBg+k/jQ1uNFuSa6qDIHhvp0FOOcOiSVJKBwVatE'); 
        $manager->persist($User);

        // Super_Admin
        $User = new User();
        $User->setemail('Super_Admin@superadmin.com');
        $User->setroles(['ROLE_SUPER-ADMIN']);
        $User->setpassword('$argon2id$v=19$m=65536,t=4,p=1$R2Z1bnJiOEdRaEZ5bDFRVA$p2CWcqmd8tn+Rk3nLcj3hoUb6OGCZyCHXCV2XJ2jTBU');
        $manager->persist($User);

        $manager->flush();
    }
}
