/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/07/11 11:16:20 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/27 18:19:17 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

int		main(void)
{
	char	*line;
	char	**args;
	t_shell	*shell;

	shell = init_shell();
	prompt(shell);
	while (1)
	{
		if (get_next_line(0, &line))
		{
			if (ft_strcmp(line, "") && check_line(line))
			{
				args = ft_strsplit(line, " \t");
				args = expansion(args, shell);
				if (!builtin(args, shell))
					launch(args, shell);
				free_tab(args);
			}
			ft_memdel((void **)&line);
			prompt(shell);
		}
	}
	return (0);
}
