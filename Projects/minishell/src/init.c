/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   init.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/12 15:06:18 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/19 18:46:42 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

t_shell     *init_shell(void)
{
    t_shell         *shell;
    extern char     **environ;
	char			cwd[1024];

    if ((shell = malloc(sizeof(t_shell))) == NULL)
        return (0);
	shell->error = 0;
	shell->oldpwd = ft_strdup(getcwd(cwd, 1024));
	if (environ[0])
	{
		shell->env = array_cpy(environ);
		shell->paths = paths(shell->env);
		shell->lenv = lenv(shell->env);
		shell->renv = renv(shell->env);
	}
	else
	{
		shell->lenv = NULL;
		shell->renv = NULL;
		shell->env = NULL;
		shell->paths = NULL;
	}
    return (shell);
}

char	**paths(char **env)
{
    int     i;
    int     j;
    char    **paths;

	i = 0;
	j = 0;
	while (env[i])
	{
		if (!ft_strncmp(env[i], "PATH=", 5))
			break;
        i++;
    }
	if (env[i])
	{
		paths = ft_strsplit_slashend(env[i] + 5, ':');
		return (paths);
	}
	return (NULL);
}

char    **array_cpy(char **src)
{
    char    **dst;
    int     i;

    i = 0;
    while (src[i])
		i++;
    if (!(dst = (char **)malloc(sizeof(char *) * (i + 1))))
		return (NULL);
    i = 0;
    while (src[i])
    {
		dst[i] = ft_strdup(src[i]);
		i++;
    }
    dst[i] = 0;
    return (dst);
}
