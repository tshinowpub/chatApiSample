<?php

namespace ChatApiSample\Primary\WebBundle\Controller\CmsAdmin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use ChatApiSample\Primary\WebBundle\Controller\CmsAdmin\AbstractCmsAdminController;

class DashboardController extends AbstractCmsAdminController
{
    /**
     * @Route("/cmsadmin/dashboard", name="cmsadmin_dashboard")
     * @Method("GET")
     * @Template("ChatApiSamplePrimaryWebBundle:CmsAdmin:Dashboard/dashboard.html.twig")
     */
    public function dashboardAction()
    {
        return [];
    }
    
}
