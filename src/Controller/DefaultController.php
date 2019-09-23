<?php

namespace App\Controller;

use App\Entity\SecurityUser;
use App\Form\RegisterUserType;
use App\Services\GiftsService;
use DateTimeZone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Address;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\File;
use App\Services\MyService;
use App\Services\MySecondService;
use App\Services\ServiceInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use App\Events\VideoCreatedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Form\VideoFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispacher;

    public function __construct(GiftsService $gifts, $logger, EventDispatcherInterface $dispatcher)
    {
        $this->dispacher = $dispatcher;
        
        //use $logger service

        // As functions in constructor execute first, we ovveride service method below as service was already called
    //    $gifts->gifts = ['a', 'b', 'c', 'd'];

    }
//    /**
//     * @Route("/", name="default")
//     */
//    /**
//     * Set variable into route and use it
//     * @Route("/{name}", name="default")
//     */
    /**
     * @Route("/home", name="home")
     * @param GiftsService $gifts
     * @param Request $request
     * @param SessionInterface $session
     * @param ServiceInterface $service
     * @param \Swift_Mailer $mailer
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     * @throws \Exception
     */

    public function index(
        GiftsService $gifts,
        Request $request,
        SessionInterface $session,
        ServiceInterface $service,
        \Swift_Mailer $mailer,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {


//        EVENTS

//        $video = new \stdClass();
//
//        $video->title =  'Funny video';
//        $video->category =  'Category';
//        $video->category =  'Category';
//
//        $event = new VideoCreatedEvent($video);
//        $this->dispacher->dispatch('video.created.event', $event);



// RENDER FORM TO THE VIEW

        $entityManager = $this->getDoctrine()->getManager();
        $videos = $entityManager->getRepository(Video::class)->findAll();
      //  dump($videos);
     //   $video = $entityManager->getRepository(Video::class)->find(1);

        $video = new Video();
        $video->setTitle('Write a blog post');
        $timezone = new DateTimeZone('America/New_York');

//       $video->setCreatedAt(new \DateTime('tomorrow'));

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            $fileName = sha1(random_bytes(14).'.'.$file->guessExtension());
            $file->move(
                $this->getParameter('video_directory'),
                $fileName
            );
//            $video->setFile($fileName);
//            $entityManager->persist($video);
//            $entityManager->flush();
//            return $this->redirectToRoute('home');
        }

// SWIFTMAILER

//        $message = (new \Swift_Message('Hello Email'))
//            ->setFrom('send@example.com')
//            ->setTo('recipient@example.com')
//            ->setBody(
//                $this->renderView(
//                // templates/emails/registration.html.twig
//                    'emails/registration.html.twig',
//                    ['name' => 'Robert']
//                ),
//                'text/html'
//            );
//        $mailer->send($message);


// SECURITY CHECK USING ANOTATIONS

//        $users = $entityManager->getRepository(SecurityUser::class)->findAll();
//        dump($users);
//        $user = new SecurityUser;
//        $user->setEmail('admin@admin.com');
//        $password = $passwordEncoder->encodePassword($user, 'password');
//        $user->setPassword($password);
//        $user->setRoles(['ROLE_ADMIN']);
//
//
//        $video = new Video;
//        $video->setTitle('video titile');
//        $video->setFile('file path');
//        $video->setCreatedAt(new \DateTime());
//        $entityManager->persist($video);
//        $user->addVideo($video);
//        $entityManager->persist($user);
//        $entityManager->flush();
//
//        dump($video->getId());







//        composer require symfony/cache PSR6 CACHE CONTROL

//            $cache = new FilesystemAdapter();
//
//            $posts = $cache->getItem('database.get_posts');
//
//            if(!$posts->isHit())
//            {
//                $posts_from_db = ['post1', 'post2', 'post3'];
//                dump('connected to Database');
//                $posts->set(serialize($posts_from_db));
//
//                $posts->expiresAfter(5);
//                $cache->save($posts);
//            }
//            $cache->deleteItem('database.get_posts');
//
//            $cache->clear();
//            dump(unserialize($posts->get()));


//   CACHE TAGS #########################################################################
//        Cache item with tags can be related so for instance you can delete all needed cache by the tag

//            $cache = new TagAwareAdapter(
//                new FilesystemAdapter()
//            );
//
//
//
//            $acer = $cache->getItem('acer');
//            $dell = $cache->getItem('dell');
//            $imb = $cache->getItem('ibm');
//
//            if (!$acer->isHit()) {
//                    $acer_from_db  = 'acer laptop';
//                    $acer->set($acer_from_db);
//                    $acer->tag(['computers', 'laptopts', 'acer']);
//                    $cache->save($acer);
//                    dump('acer laptop from db');
//            }
//
//            if (!$dell->isHit()) {
//                $dell_from_db  = 'dell laptop';
//                $dell->set($dell_from_db);
//                $dell->tag(['computers', 'desktops', 'dell']);
//                $cache->save($dell);
//                dump('dell laptop from db');
//            }
//
//            if (!$imb->isHit()) {
//                $imb_from_db  = 'ibm laptop';
//                $imb->set($imb_from_db);
//                $imb->tag(['computers', 'desktops', '$ibm']);
//                $cache->save($imb);
//                dump('$ibm dekstop from db');
//            }
//            $cache->invalidateTags(['desktops']);
//
//            dump($acer->get());
//            dump($dell->get());
//            dump($imb->get());

//        $users  = $this->getDoctrine()->getRepository(User::class)->findAll();

//        if (!$users)
//        {
//            throw $this->createNotFoundException('User does not exist');
//        }







//        CRUD

//            WRITE

//        $entityManager = $this->getDoctrine()->getManager();
//        $user = new User();
//        $user->setName('Robert');
//        $entityManager->persist($user);
////        $entityManager->flush();
////       var_dump('A new user saved with id of '.$user->getId());

//        READ
//        $repository = $this->getDoctrine()->getManager()->getRepository(User::class );
//        FIND ONE RECORD
//        $user = $repository->find(1);
//        $user = $repository->findOneBy(['name' => 'Robert']);
//        FIND MULTIPLE RECORDS
//         $user = $repository->findBy(['name' => 'name - 1'],
//             ['id' => 'DESC']);
//        $user = $repository->findAll();

//        UPDATE
//        $entityManager = $this->getDoctrine()->getManager();
//        $id = 2;
//        $user = $entityManager->getRepository(User::class)->find($id);
//        if (!$user)
//        {
//            throw $this->createNotFoundException('No user found for id: '.$id);
//        }
//        $user->setName('New user name!');
//        $entityManager->flush();

//        DELETE

//        $entityManager = $this->getDoctrine()->getManager();
//        $id = 2;
//        $user = $entityManager->getRepository(User::class)->find($id);
//        $entityManager->remove($user);
//        $entityManager->flush();

//        CRUD END



//        RAW QUERIES

//        $entityManager = $this->getDoctrine()->getManager();
//    $conn = $entityManager->getConnection();
//    $sql = '
//    SELECT * FROM user u
//    WHERE u.id > :id
//    ';
//    $stmt = $conn->prepare($sql);
//    $stmt->execute(['id' => 3]);
//
//    var_dump($stmt->fetchAll());

//    RAW QUERIES END





//      TESTING VIDEO AND USER RELATIOSHIP


//        $entityManager = $this->getDoctrine()->getManager();
//        $user = new User();
//        $user->setName('Robert');
//
//        for ($i=1; $i<=3; $i++) {
//            $video = new Video();
//            $video->setTitle('Video title - '.$i);
//            $user->addVideo($video);
//            $entityManager->persist($video);
//        }
//        $entityManager->persist($user);
//
//        $entityManager->flush();
//
//        var_dump('Video: '.$video->getId());

//FIND VIDEO
//        $video = $this->getDoctrine()->getRepository(Video::class)->find(1);
//        var_dump($video->getUser()->getName());

//
//



//       FIND USER
//        $user = $this->getDoctrine()->getRepository(User::class)->find(16);
//
//        foreach ($user->getVideos() as $video) {
//            var_dump($video->getTitle());
//        }

//      TESTING VIDEO AND USER RELATIOSHIP END

//        DELETETING STUFF WITH CASCADE PROPERTY


// CASCADE property lays in entity property on forgein key



//        $manager = $this->getDoctrine()->getManager();
//
//        $user =  $this->getDoctrine()->getRepository(User::class)->find(1);
//
//        $manager->remove($user);
//        $manager->flush();
//

// ORPHAN
//        $manager = $this->getDoctrine()->getManager();
//
//        $user =  $this->getDoctrine()->getRepository(User::class)->find(2);
//
//        $video = $this->getDoctrine()->getRepository(Video::class)->find(4);
//        $user->removeVideo($video);
//        $manager->flush();
//        foreach ($user->getVideos() as $video) {
//            var_dump($video->getTitle());
//        }


// PERSIST

//        $entityManager = $this->getDoctrine()->getManager();
//        $user = new User();
//        $user->setName('John');
//        $address = new Address();
//        $address->setStreet('street');
//        $address->setNumber(153);
//        $user->setAdress($address);
//        $entityManager->persist($user);
////        $entityManager->persist($address); //required if cascade option is not set on the user entity
//        $entityManager->flush();
//        var_dump($user->getAdress()->getStreet());

// MANY TO MANY RELATIONASHIPS




//        $entityManager = $this->getDoctrine()->getManager();
//        for ($i=1; $i<=4; $i++) {
//            $user = new User();
//            $user->setName('Anuska - '.$i);
//            $entityManager->persist($user);
//        }
//        $entityManager->flush();
//
//        var_dump('last_id '.$user->getId());


//       $entityManager = $this->getDoctrine()->getManager();
//
//        $user1 = $this->getDoctrine()->getRepository(User::class)->find(5);
//        $user2 = $this->getDoctrine()->getRepository(User::class)->find(2);
//        $user3 = $this->getDoctrine()->getRepository(User::class)->find(3);
//        $user4 = $this->getDoctrine()->getRepository(User::class)->find(4);
//
//        $user1->addFollowed($user2);
//        $user1->addFollowed($user3);
//        $user1->addFollowed($user4);
//        $entityManager->flush();
//
//
//var_dump($user1->getFollowed()->count());




// EAGER LOADING OVER LAZY LOADING (USUALY USED FOR PERFORMANCE FRONTEND TASKS) (check user repo)



//               $entityManager = $this->getDoctrine()->getManager();
//               $user = new User();
//               $user->setName('Juozukas');
//
//        for ($i=1; $i<=4; $i++) {
//            $video = new Video();
//            $video->setTitle('Video title - '. $i);
//            $user->addVideo($video);
//            $entityManager->persist($video);
//        }
//        $entityManager->persist($user);
//
//        $entityManager->flush();

//        echo '<pre>';
//        $user = $entityManager->getRepository(User::class)->findWithVideos(10);
//        var_dump($user); die;





//        DOCTRINE INHERITANCE MAPPING
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $pdf = $this->getDoctrine()->getRepository(Pdf::class)->findAll();
//        $video = $this->getDoctrine()->getRepository(Video::class)->findAll();
////        polymorphyc quiery as abstract File can use only select quieries
//        $file = $this->getDoctrine()->getRepository(File::class)->findAll();
////        $author = $this->getDoctrine()->getRepository(Author::class)->find(1);
//        $author = $this->getDoctrine()->getRepository(Author::class)->findByIdWithPdf(1);
//
//        foreach ($author->getFiles() as $file) {
////            if ($file instanceof Pdf) {
//                dump($file->getFileName());
////            }
//        }




//$service->someAction();








// POST AND GET
//        exit($request->get('page', 'default')); // get data from $_GET
        $request->isXmlHttpRequest(); // is it an Ajax request?
        $request->request->get('page'); // get $_POST data
        $request->files->get('foo'); // get uploaded file data

// SESSION
//        $session->set('name', 'session value');
//        $session->remove('name');
//
//        $session->clear();      // clears all session data
//        if ($session->has('name'))
//        {
//            exit($session->get('name'));
//        };
// COOKIE
//        exit($request->cookies->get('PHPSESSID'));
//        $cookie = new Cookie(
//            'my_cookie',
//            'cookie_value',
//            time() + (2 * 365 * 24 * 60 * 60)
//        );
//
//        $res = new Response();
//        $res->headers->setCookie($cookie);
//        $res->send();
//
//        $res->headers->clearCookie('my_cookie'); // clears stored cookie on denmand

        //ADD TO DATABASE
//        $entityManager = $this->getDoctrine()->getManager(); //responsible for saving operations to DB
//        $user = new User;
//        $user->setName('Bob');
//        $entityManager->persist($user);
//        $entityManager->flush();
        // This was moved to service section
//        $gifts = array('flowers', 'car', 'piano', 'money');
//
//        shuffle($gifts);

        // FLASH MESSAGES

        $this->addFlash(
            'notice',
            'Your changes has been saved!'
        );
        $this->addFlash(
                'warning',
                'Your message has errors be careful!'
            );

//       RENDER CONTROLLERS WITH PARAMS
//        return $this->render('default/index.html.twig', array(
//            'controller_name' => 'DefaultController',
//            'users' => $users,
//            'random_gift' => $gifts->gifts,
//        ));




//        RESPONSE WITH DYNAMIC VARS
//         return new Response("Hello there $name");
//        JSON
//        return $this->json(array(
//            'username'=> 'john.doe'
//        ));
//        Redirect to another page
//        return $this->redirect('https://toybox.lt');

//        return $this->redirectToRoute('default2');

        return $this->render('default/index.html.twig', array(
            'controller_name' => 'DefaultController',
            'form' => $form->createView(),
        ));
    }

//    /**
//     * @Route("/default2/", name="default2")
//     */
//    public function index2()
//    {
//        return new Response("Another route");
//    }

// no route cuz this methos only gonna be used to render html


    public function mostPopularPosts($number = 3)
    {
        // database call
        $posts = ['post_1', 'post_2', 'post_3', 'post_4'];
        return $this->render('default/most_popular_posts.html.twig', [
            'posts' => $posts,
        ]);
    }
    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     *
     */
    /* if {page?} means its optional*/
    public function index2()
    {
        return new Response('bla bla');
    }
// advanced route with many paramters
    /**
     * @Route(
     *     "/articles/{_locale}/{year}/{slug}/{category}",
     *     defaults={"category": "computers"},
     *     requirements={
     *      "_locale": "en|fr",
     *      "category": "computers|rtv",
     *      "year": "\d+"
     *  }
     * )
     */
    public function index3()
    {
        return new Response('Advanced Route');
    }
//Translations for root
    /**
     * @Route({
     *     "nl": "/beleka",
     *     "en": "/something"
     *  }, name="about_us"
     * )
     */
    public function index4()
    {
        return new Response('Translated route');
    }

    /**
     * @Route("/generate-url/{param?}", name= "generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL)

        );
    }

    /**
     * @Route("/download")
     */
    public function download()
    {
        $path = $this->getParameter('download_directory');

        return $this->file($path.'photo.jpg');
    }

    /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));
    }

    /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test Redirection');
    }

    /**
     * @Route("forwarding-to-controller")
     */
    public function forwardingToController()
    {
        $response = $this->forward(
            'App\Controller\DefaultController:methodToForwardTo',
            array('param' => 1)
        );
        return $response;
    }

    /**
     * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
     */
    public function methodToForwardTo($param)
    {
        exit('Test controller forwarding - '.$param);
    }




// GET USER WITHOU ENTITY MANAGER

    // advanced route with many paramters
    /**
     * @Route("/without-manager/{id}")
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function indexUser(Request $request, User $user)
    {
        var_dump($user);
        return new Response('Get Params without manager');
    }

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function registerAction(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
//        $this->denyAccessUnlessGranted('ROLE_ADMIN');
//       $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//       $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');



        $manager = $this->getDoctrine()->getManager();
        $user = new SecurityUser();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $form->get('password')
                    ->getData())
            );
            $user->setEmail($form->get('email')->getData());

            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('default/register.html.twig', array(
            'name' => 'Register',
            'form' => $form->createView()
        ));

    }

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error
        ));
    }

    /**
     * @Route("/home/{id}/delete-video", name="delete-video")
     * @param Video $video
     * @return Response
     * @Security("user.getId() == video.getSecurityUser().getId()")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteVideo(Video $video)
    {
        $manager = $this->getDoctrine()->getManager();
        $video = $manager->getRepository(Video::class)->find(1);
        $users = $manager->getRepository(SecurityUser::class)->findAll();

//        VOTERS
        $this->denyAccessUnlessGranted('VIDEO_DELETE', $video);
        dump($video);
        dump($users);
        return $this->render('/base.html.twig', array(
            'controller_name' => 'DefaultController',
        ));

    }
}
