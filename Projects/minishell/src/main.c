/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/07/11 11:16:20 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/19 21:35:30 by jmondino         ###   ########.fr       */
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
			if (ft_strcmp(line, ""))
			{
				args = ft_strsplit(line, " \t");
				args = expansion(args, shell);
				if (!builtin(args, shell))
					launch(args, shell);
				ft_memdel((void **) &line);
				ft_memdel((void **) args);
			}
			prompt(shell);
		}
	}
	return (0);
}
